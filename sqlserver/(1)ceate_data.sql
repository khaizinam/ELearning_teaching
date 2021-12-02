
/*********************************/
/*                               */
/*         CREATE DB             */
/*                               */
/*********************************/
CREATE DATABASE E_LEARNING_TEACHING_BETA;  
go


USE E_LEARNING_TEACHING_BETA; 
go



/*********************************/
/*                               */
/*            OBJECT             */
/*                               */
/*********************************/
/* 1 */
CREATE TABLE Department (
    ID INT NOT NULL IDENTITY(1,1),
    name NVARCHAR(50) NOT NULL,
    PRIMARY KEY (ID)
);
---------------------------------------------------------------------------------------
/* 2 */
CREATE TABLE lecturer (
    ID DECIMAL(7,0) NOT NULL ,
    full_name NVARCHAR(100) NOT NULL,
    DepartmentID INT NOT NULL,
    PRIMARY KEY(ID),
    FOREIGN KEY (DepartmentID) 
        REFERENCES Department(ID)
);

----------------------------------------------------------------------

/* 3 */
CREATE TABLE pupil (
    ID DECIMAL(7,0) NOT NULL ,
    full_name NVARCHAR(100) NOT NULL,
    status VARCHAR(50) NOT NULL,
    DepartmentID INT NOT NULL,
    PRIMARY KEY(ID),
    FOREIGN KEY (DepartmentID) 
        REFERENCES Department(ID)
);

----------------------------------------------------------------------
/* 4 */
CREATE TABLE subject (
    ID VARCHAR(10) NOT NULL,
    name NVARCHAR(255) NOT NULL,
    credits INT NOT NULL CHECK (Credits > 0 AND Credits < 6),
    DepartmentID INT NOT NULL,
	PRIMARY KEY(ID),
    FOREIGN KEY (DepartmentID) 
        REFERENCES Department(ID)
);

----------------------------------------------------------------------
/* 5 */
CREATE TABLE class (
    ID VARCHAR(10) NOT NULL,
    semester INT NOT NULL,
	name VARCHAR(10) NOT NULL,
    subjectID VARCHAR(10) NOT NULL,
	PRIMARY KEY(ID),
    FOREIGN KEY (subjectID) 
        REFERENCES subject(ID)
);


-----------------------------------------------------------------------------------
/* 6 */
CREATE TABLE textbook (
    Isbn DECIMAL(13,0) NOT NULL,
    title VARCHAR(255) NOT NULL,
    field VARCHAR(255) NOT NULL,
    PRIMARY KEY (Isbn)
);
-----------------------------------------------------------------------------------
/* 7 */
CREATE TABLE publisher (
    ID INT NOT NULL IDENTITY(1,1),
    name NVARCHAR(255) NOT NULL,
    PRIMARY KEY (ID)
);
/* 8 */
CREATE TABLE author (
    ID INT NOT NULL IDENTITY(1,1),
    name NVARCHAR(255) NOT NULL,
    PRIMARY KEY (ID)
);
/*********************************/
/*                               */
/*        RELASHION SHIP         */
/*                               */
/*********************************/
/* 9 */
CREATE TABLE Enrolls ( 
    ID INT NOT NULL IDENTITY(1,1),
    semester INT NOT NULL,
    pupilID DECIMAL(7,0) NOT NULL,
	subjectID VARCHAR(10) NOT NULL ,
    PRIMARY KEY (ID),
    FOREIGN KEY (pupilID) 
        REFERENCES pupil(ID),
    FOREIGN KEY (subjectID) 
        REFERENCES subject(ID)
);
/* 9 */
CREATE TABLE manageClass (
    ID INT NOT NULL IDENTITY(1,1),
    classID VARCHAR(10) NOT NULL ,
    lecturerID DECIMAL(7,0) NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (classID) 
        REFERENCES class(ID),
    FOREIGN KEY (lecturerID) 
        REFERENCES lecturer(ID)
);
---------------------------------------------------------------------------
/* 10 */
CREATE TABLE attendsClass (
    ID INT NOT NULL IDENTITY(1,1),
    classID VARCHAR(10) NOT NULL ,
    pupilID DECIMAL(7,0) NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (pupilID) 
        REFERENCES pupil(ID),
    FOREIGN KEY (classID) 
        REFERENCES class(ID),
);
------------------------------------------------------------------------
/* 11 */
CREATE TABLE manageSubject (
    ID INT NOT NULL IDENTITY(1,1),
    semester INT NOT NULL,
    subjectID VARCHAR(10) NOT NULL,
    lecturerID DECIMAL(7,0) NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (subjectID) 
        REFERENCES subject(ID),
    FOREIGN KEY (lecturerID) 
        REFERENCES lecturer(ID),
);
---------------------------------------------------------------------------
/* 12 */
CREATE TABLE assignsTextBook (
    ID INT NOT NULL IDENTITY(1,1),
    semester INT NOT NULL,
    subjectID VARCHAR(10) NOT NULL,
    textbookID DECIMAL(13,0) NOT NULL, 
    PRIMARY KEY (ID),
    FOREIGN KEY (subjectID) 
        REFERENCES subject(ID),
    FOREIGN KEY (textbookID) 
        REFERENCES textbook(Isbn),
);
------------------------------------------------------------------------------
/* 13 */
CREATE TABLE teaches (
    ID INT NOT NULL IDENTITY(1,1),
    week INT NOT NULL,
    classID VARCHAR(10) NOT NULL ,
    lecturerID DECIMAL(7,0) NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (classID) 
        REFERENCES class(ID),
    FOREIGN KEY (lecturerID) 
        REFERENCES lecturer(ID),
);
------------------------------------------------------------------------------
/* 14 */
CREATE TABLE useTextbook (
    ID INT NOT NULL IDENTITY(1,1),
    subjectID VARCHAR(10) NOT NULL,
    textbookID DECIMAL(13,0) NOT NULL, 
    PRIMARY KEY (ID),
    FOREIGN KEY (subjectID) 
        REFERENCES subject(ID),
    FOREIGN KEY (textbookID) 
        REFERENCES textbook(Isbn),
);
------------------------------------------------------------------------------
/* 15 */
CREATE TABLE publishes(
    ID INT NOT NULL IDENTITY(1,1),
    textbookID DECIMAL(13,0) NOT NULL, 
    publisherID INT NOT NULL,
    PublishedDate DATETIME ,
    PRIMARY KEY (ID),
    FOREIGN KEY (textbookID) 
        REFERENCES textbook(Isbn),
    FOREIGN KEY (publisherID) 
        REFERENCES publisher(ID),

);
------------------------------------------------------------------------------
/* 16 */
CREATE TABLE writes(
    ID INT NOT NULL IDENTITY(1,1),
    textbookID DECIMAL(13,0) NOT NULL, 
    authorID INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (textbookID) 
        REFERENCES textbook(Isbn),
    FOREIGN KEY (authorID) 
        REFERENCES author(ID),
);


/*********************************/
/*                               */
/*           Triger              */
/*                               */
/*********************************/


---------------------------------------------------------------

create trigger deletePupil on pupil  
INSTEAD OF DELETE 
as
begin
	delete from Enrolls where pupilID = (SELECT deleted.ID FROM deleted);
	delete from attendsClass  Where pupilID = (SELECT deleted.ID FROM deleted);
	delete from pupil Where ID = (SELECT deleted.ID FROM deleted);
end;
go

create trigger deleteLecturer on lecturer 
INSTEAD OF DELETE
as
begin
	delete from manageClass where lecturerID = (SELECT deleted.ID FROM deleted);
	delete from manageSubject  Where lecturerID = (SELECT deleted.ID FROM deleted);
	delete from teaches Where lecturerID = (SELECT deleted.ID FROM deleted);
	delete from lecturer Where ID = (SELECT deleted.ID FROM deleted);
end;
go

create trigger deleteFalcuty on Department 
INSTEAD OF DELETE
as
begin
	delete from lecturer where DepartmentID = (SELECT deleted.ID FROM deleted);
	delete from pupil  Where DepartmentID = (SELECT deleted.ID FROM deleted);
	delete from subject Where DepartmentID = (SELECT deleted.ID FROM deleted);
	delete from Department Where ID = (SELECT deleted.ID FROM deleted);
end;
go

create trigger deleteSubject on subject 
INSTEAD OF DELETE
as
begin
	delete from class where subjectID = (SELECT deleted.ID FROM deleted);
	delete from Enrolls  Where subjectID = (SELECT deleted.ID FROM deleted);
	delete from manageSubject  Where subjectID = (SELECT deleted.ID FROM deleted);
	delete from assignsTextBook  Where subjectID = (SELECT deleted.ID FROM deleted);
	delete from useTextbook Where subjectID = (SELECT deleted.ID FROM deleted);
	delete from subject Where ID = (SELECT deleted.ID FROM deleted);
end;
go

create trigger deleteTextbook on textbook 
INSTEAD OF DELETE
as
begin
	delete from assignsTextBook  Where textbookID = (SELECT deleted.Isbn FROM deleted);
	delete from useTextbook  Where textbookID = (SELECT deleted.Isbn FROM deleted);
	delete from publishes  Where textbookID = (SELECT deleted.Isbn FROM deleted);
	delete from writes Where textbookID = (SELECT deleted.Isbn FROM deleted);
	delete from textbook Where Isbn = (SELECT deleted.Isbn FROM deleted);
end;
go
create trigger deleteClass on class 
INSTEAD OF DELETE
as
begin
	delete from manageClass  Where classID = (SELECT deleted.ID FROM deleted);
	delete from attendsClass Where classID = (SELECT deleted.ID FROM deleted);
	delete from teaches Where classID = (SELECT deleted.ID FROM deleted);
	delete from class Where ID = (SELECT deleted.ID FROM deleted);
end;
go
create trigger deleteAuthor on author 
INSTEAD OF DELETE
as
begin
	delete from writes  Where authorID = (SELECT deleted.ID FROM deleted);
	delete from author Where ID = (SELECT deleted.ID FROM deleted);
end;
go
------------------------------------------------------------------------------


/*********************************/
/*                               */
/*         DATA                  */
/*                               */
/*********************************/
----------------------------------------------------------
INSERT INTO Department (name) 
VALUES
(N'Khoa học và máy tính'),(N'Kĩ THuật máy tính'),(N'Dệt may'),(N'Cơ khí'),(N'Môi trường địa chất')


----------------------------------------------------------
INSERT INTO lecturer
VALUES 
('5012345', N'Nguyễn Hữu Luân','1'),('5012478',N'Trần Thanh Thuyết','2'),('5012479',N'Trần Thanh Như','2')
----------------------------------------------------------
INSERT INTO pupil
VALUES 
('210457', N'Nguyễn Hữu Khải','Active','1'),('1913778',N'Nguyễn Thành Luân','Active','1')

--------------------------------------------------------
INSERT INTO subject 
values
('CO2004',N'Hệ Cơ sở DL','3','1'),('SP1008',N'Pháp Luat VN đại cương','4','1')
----------------------------------------------------------
INSERT INTO class 
VALUES 
('100', N'201','L05','CO2004');

--------------------------------------------------------
INSERT INTO textbook
VALUES 
('10045788', 'Pháp luật Việt Nam Đại cương' ,'xxxxxxxxxx')
--------------------------------------------------------
INSERT INTO publisher (name)
VALUES
(N'NXB Kim Dung'),(N'NXB và GDĐT')
--------------------------------------------------------

INSERT INTO author  (name)
values
(N'Trần Văn Lượng')

----------------------------------------------------------
INSERT INTO Enrolls (semester, pupilID,subjectID)
values 
('201','210457','CO2004')
INSERT INTO manageClass (classID, lecturerID)
values 
('100','5012345')

INSERT INTO attendsClass (classID,pupilID)
values 
('100','210457')

INSERT INTO manageSubject (semester,subjectID, lecturerID)
values 
('201','CO2004','5012345')

INSERT INTO assignsTextBook (semester,subjectID, textbookID)
values 
('201','CO2004','10045788')

INSERT INTO teaches (week,classID, lecturerID)
values 
('46','100','5012345')

INSERT INTO useTextbook (subjectID,textbookID)
values 
('CO2004','10045788')

INSERT INTO publishes (textbookID,publisherID, PublishedDate)
values 
('10045788','1','01/02/2021')

INSERT INTO writes (textbookID,authorID)
values 
('10045788','1')

/*********************************/
/*                               */
/*            QUERY              */
/*                               */
/*********************************/
SELECT class.ID ,class.name,lecturer.full_name as LecturerName , lecturer.ID as LecturerID
		FROM ((manageClass 
		INNER JOIN lecturer ON manageClass.lecturerID = lecturer.ID)
		INNER JOIN class ON class.ID = manageClass.classID);

SELECT Enrolls.ID ,Enrolls.semester,pupil.full_name as StudentName,pupil.ID as MSSV , subject.name as courseName , subject.ID as courseID
		FROM ((Enrolls 
		INNER JOIN pupil ON Enrolls.pupilID = pupil.ID)
		INNER JOIN subject ON Enrolls.subjectID = subject.ID);

SELECT manageClass.ID , class.name as className , lecturer.full_name as lecturerName , lecturer.ID as lecturerID
		FROM ((manageClass 
		INNER JOIN class ON manageClass.classID = class.ID)
		INNER JOIN lecturer ON manageClass.lecturerID = lecturer.ID);

SELECT manageSubject.ID , manageSubject.semester,lecturer.full_name as lecturerName , lecturer.ID as lecturerID,subject.name as subjecName, subject.ID as courseID
		FROM ((manageSubject 
		INNER JOIN lecturer ON manageSubject.lecturerID = lecturer.ID)
		INNER JOIN subject ON manageSubject.subjectID = subject.ID);
SELECT  teaches.ID ,teaches.week , lecturer.full_name as lecturerName , lecturer.ID as lecturerID,class.name as className
		FROM ((teaches 
		INNER JOIN lecturer ON teaches.lecturerID = lecturer.ID)
		INNER JOIN class ON teaches.classID = class.ID);


CREATE FUNCTION studentList(@classID VARCHAR(10))
RETURNS TABLE
RETURN
(
		SELECT class.name,pupil.full_name as studentName,pupil.ID as MSSV, Department.name as Department
		FROM (((attendsClass 
		INNER JOIN class
		ON attendsClass.classID = class.ID)
		INNER JOIN pupil
		ON attendsClass.pupilID = pupil.ID)
		INNER JOIN Department
		ON pupil.DepartmentID = Department.ID)
		WHERE classID = @classID
)
GO


