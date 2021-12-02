
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

