/*********************************/
/*                               */
/*            CLEAR              */
/*                               */
/*********************************/
DROP DATABASE E_LEARNING_TEACHING;  

/*********************************/
/*                               */
/*         CREATE DB             */
/*                               */
/*********************************/

CREATE DATABASE E_LEARNING_TEACHING;  
go
USE E_LEARNING_TEACHING; 
go
/*********************************/
/*                               */
/*            TABLE              */
/*                               */
/*********************************/
/* 1 */
CREATE TABLE lecturer (
    ID VARCHAR(10) NOT NULL PRIMARY KEY,
    full_name NVARCHAR(100) NOT NULL,
    Email NVARCHAR(100) NOT NULL,
    p_number VARCHAR(10),
    falcuty_ID VARCHAR(10) NOT NULL,
);
---------------------------------------------------------------------------------------
/* 2 */
CREATE TABLE class (
    ID VARCHAR(10) NOT NULL PRIMARY KEY,
	name VARCHAR(10) NOT NULL,
    start_at VARCHAR(5) NOT NULL,
	end_at VARCHAR(5) NOT NULL,
    room VARCHAR(50) NOT NULL,
	lecturer_ID VARCHAR(10) NOT NULL,
    subject_ID VARCHAR(10) NOT NULL,
);
----------------------------------------------------------------------
/* 3 */
CREATE TABLE pupil (
    ID VARCHAR(10) NOT NULL PRIMARY KEY,
    full_name NVARCHAR(100) NOT NULL,
    class VARCHAR(100) NOT NULL,
    Email NVARCHAR(200) NOT NULL,
    status NVARCHAR(100) NOT NULL,
    falcuty_ID VARCHAR(10) NOT NULL,
);
----------------------------------------------------------------------
/* 4 */
CREATE TABLE room (
    name VARCHAR(50) NOT NULL PRIMARY KEY,
	building NVARCHAR(100) NOT NULL,
);
----------------------------------------------------------------------
/* 5 */
CREATE TABLE falcuty (
    ID VARCHAR(10) NOT NULL,
    name NVARCHAR(50) NOT NULL,
    PRIMARY KEY (ID)
);

-----------------------------------------------------------------------------------
/* 6 */
CREATE TABLE subject (
    ID VARCHAR(10) NOT NULL PRIMARY KEY,
    name NVARCHAR(100) NOT NULL,
    num_credit SMALLINT NOT NULL
);
-----------------------------------------------------------------------------------
/* 7 */
CREATE TABLE text_book (
    ID VARCHAR(10) NOT NULL,
    name VARCHAR(50) NOT NULL,
    publishing_year VARCHAR(4) NOT NULL,
    PRIMARY KEY (ID)
);
/* 8 */
CREATE TABLE author (
    ID VARCHAR(10) NOT NULL,
    full_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (ID)
);
----------------------------------------------------------------------------
/* 9 */
CREATE TABLE studentList (
    pupil_ID VARCHAR(10) NOT NULL,
	group_ID VARCHAR(10) NOT NULL ,
);
/* 10 */
CREATE TABLE lecturerList (
    lecturer_ID VARCHAR(10) NOT NULL,
	class_ID VARCHAR(10) NOT NULL ,
);

------------------------------------------------------------------------
/* 11 */
CREATE TABLE education (
    falcuty_ID VARCHAR(10) NOT NULL,
    subject_ID VARCHAR(10) NOT NULL,
    PRIMARY KEY (falcuty_ID, subject_ID)
);
---------------------------------------------------------------------------
/* 12 */
CREATE TABLE subjectManage (
    lecturer_ID VARCHAR(10) NOT NULL,
    subject_ID VARCHAR(10) NOT NULL,
    tex_book_ID VARCHAR(10) NOT NULL,
    PRIMARY KEY (lecturer_ID, subject_ID, tex_book_ID)
);

------------------------------------------------------------------------------
/* 13 */
CREATE TABLE compilation (
    tex_book_ID VARCHAR(10) NOT NULL,
    author_ID VARCHAR(10) NOT NULL,
    PRIMARY KEY (tex_book_ID, author_ID)
);
------------------------------------------------------------------------------


/*********************************/
/*                               */
/*         FOREIGN KEY           */
/*                               */
/*********************************/

ALTER TABLE lecturer ADD CONSTRAINT fk_lecturer_falcutyID FOREIGN KEY (falcuty_ID) REFERENCES falcuty(ID);

-----------------------------------------------------------------------------------------------------------
ALTER TABLE class ADD CONSTRAINT fk_class_subjectID FOREIGN KEY (subject_ID) REFERENCES subject(ID);
ALTER TABLE class ADD CONSTRAINT fk_class_lectureID FOREIGN KEY (lecturer_ID) REFERENCES lecturer(ID);
ALTER TABLE class ADD CONSTRAINT fk_class_room FOREIGN KEY (room) REFERENCES room(name);

------------------------------------------------------------------------------------------------------------
ALTER TABLE pupil ADD CONSTRAINT fk_pupil_falcutyID FOREIGN KEY (falcuty_ID) REFERENCES falcuty(ID);

--------------------------------------------------------------------
ALTER TABLE studentList ADD CONSTRAINT fk_studentList_pupilID FOREIGN KEY (pupil_ID) REFERENCES pupil(ID);
ALTER TABLE studentList ADD CONSTRAINT fk_studentList_classID FOREIGN KEY (group_ID) REFERENCES class(ID);

--------------------------------------------------------------------
ALTER TABLE lecturerList ADD CONSTRAINT fk_lecturerList_lectureID FOREIGN KEY (lecturer_ID) REFERENCES lecturer(ID);
ALTER TABLE lecturerList ADD CONSTRAINT fk_lecturerList_classID FOREIGN KEY (class_ID) REFERENCES class(ID);

--------------------------------------------------------------------
ALTER TABLE education ADD CONSTRAINT fk_education_falcutyID FOREIGN KEY (falcuty_ID) REFERENCES falcuty(ID);
ALTER TABLE education ADD CONSTRAINT fk_education_subjectID FOREIGN KEY (subject_ID) REFERENCES subject(ID);

--------------------------------------------------------------------
ALTER TABLE subjectManage ADD CONSTRAINT fk_subjectManage_lectureID FOREIGN KEY (lecturer_ID) REFERENCES lecturer(ID);
ALTER TABLE subjectManage ADD CONSTRAINT fk_subjectManage_subjectID FOREIGN KEY (subject_ID) REFERENCES subject(ID);
ALTER TABLE subjectManage ADD CONSTRAINT fk_subjectManage_texbookID FOREIGN KEY (tex_book_ID) REFERENCES text_book(ID);

---------------------------------------------------------------------
ALTER TABLE compilation ADD CONSTRAINT fk_compilation_texbookID FOREIGN KEY (tex_book_ID) REFERENCES text_book(ID);
ALTER TABLE compilation ADD CONSTRAINT fk_compilation_authorID FOREIGN KEY (author_ID) REFERENCES author(ID);
/*********************************/
/*                               */
/*         DATA                  */
/*                               */
/*********************************/
----------------------------------------------------------
INSERT INTO falcuty 
values
('1001',N' Học Máy Tinh'),('1002',N'Kĩ Thuật Máy Tính')

----------------------------------------------------------
INSERT INTO pupil
VALUES 
('1913779', N'Nguyễn Hữu Khải','L07','khai.nguyenhuu@hcmut.edu.vn','normal','1001' )

----------------------------------------------------------
INSERT INTO lecturer
VALUES 
('5012345', N'Nguyễn Hữu Luân','luan.nguyenhuu@hcmut.edu.vn','0846141788','1001' )

--------------------------------------------------------
INSERT INTO subject 
values
('CO2004',N'Hệ Cơ sở DL','3'),('SP1008',N'Pháp Luat VN đại cương','4')
----------------------------------------------------------
INSERT INTO room 
VALUES 
('202H3', N'H3');

--------------------------------------------------------
INSERT INTO class
VALUES 
('1001', 'L05' ,'4','6','202H3','5012345','CO2004')
--------------------------------------------------------
INSERT INTO studentList
VALUES 
('1913779', '1001' )
--------------------------------------------------------

INSERT INTO lecturerList 
values
('5012345','1001')

----------------------------------------------------------

/*********************************/
/*                               */
/*            QUERY              */
/*                               */
/*********************************/
-----------GOI danh sach GV-------------------
SELECT lecturer.full_name,lecturer.ID,lecturer.Email,lecturer.p_number ,falcuty.name
FROM lecturer INNER JOIN falcuty 
ON lecturer.falcuty_ID = falcuty.ID


-----------GOI danh sach SV-------------------
SELECT pupil.full_name as full_name, pupil.ID as MSSV,pupil.Email , pupil.class,pupil.status as tinh_trang_hoc,falcuty.name as falcuty
FROM pupil INNER JOIN falcuty 
ON pupil.falcuty_ID = falcuty.ID;

-----------GOI danh sach nhom class-------------------
SELECT class.name as ten_nhom_lop,class.start_at,class.end_at,class.room,lecturer.full_name as giang_vien_phu_trach,subject.name as subject
FROM ((class 
INNER JOIN lecturer ON class.lecturer_ID = lecturer.ID)
INNER JOIN subject ON class.subject_ID = subject.ID);

-----------GOI danh sach hoc sinh trong class-------------------
SELECT class.name as class,pupil.full_name as full_name,pupil.ID as MSSV , pupil.Email,pupil.class,falcuty.name as falcuty
FROM (((studentList 
INNER JOIN class
ON studentList.group_ID = class.ID)
INNER JOIN pupil
ON studentList.pupil_ID = pupil.ID)
INNER JOIN falcuty
ON pupil.falcuty_ID = falcuty.ID);

-----------GOI danh sach GV quan li class-------------------
SELECT class.name as class, lecturer.full_name,lecturer.ID,lecturer.Email,lecturer.p_number ,falcuty.name as falcuty
FROM (((lecturerList 
INNER JOIN class 
ON lecturerList.class_ID = class.ID)
INNER JOIN lecturer 
ON lecturerList.lecturer_ID = lecturer.ID)
INNER JOIN falcuty 
ON lecturer.falcuty_ID = falcuty.ID);


/*********************************/
/*                               */
/*           TRIGGER             */
/*                               */
/*********************************/