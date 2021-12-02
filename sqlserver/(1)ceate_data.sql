
/*********************************/
/*                               */
/*         CREATE DB             */
/*                               */
/*********************************/


CREATE DATABASE E_LEARNING_TEACHING_BETA_2;  
go


USE E_LEARNING_TEACHING_BETA_2; 
go



/*********************************/
/*                               */
/*            OBJECT             */
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
CREATE TABLE author (
    ID VARCHAR(10) NOT NULL,
    full_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (ID)
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
/*********************************/
/*                               */
/*        RELASHION SHIP         */
/*                               */
/*********************************/
/* 8 */
CREATE TABLE room (
    name VARCHAR(50) NOT NULL PRIMARY KEY,
	building NVARCHAR(100) NOT NULL,
);
----------------------------------------------------------------------------
/* 9 */
CREATE TABLE studentList (
    pupil_ID VARCHAR(10) NOT NULL,
	class_ID VARCHAR(10) NOT NULL ,
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
);
---------------------------------------------------------------------------
/* 12 */
CREATE TABLE subjectManage (
    lecturer_ID VARCHAR(10) NOT NULL,
    subject_ID VARCHAR(10) NOT NULL,
    tex_book_ID VARCHAR(10) NOT NULL,
);

------------------------------------------------------------------------------
/* 13 */
CREATE TABLE compilation (
    tex_book_ID VARCHAR(10) NOT NULL,
    author_ID VARCHAR(10) NOT NULL,
);
/* 14 */
CREATE TABLE registerSubject(
    pupil_ID VARCHAR(10) NOT NULL,
    subject_ID VARCHAR(10) NOT NULL,
);
/* 15 */
CREATE TABLE creditPupil(
    pupilID VARCHAR(10) NOT NULL,
    numCredit SMALLINT NOT NULL,
	totalCredit SMALLINT NOT NULL,
);


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
ALTER TABLE studentList ADD CONSTRAINT fk_studentList_classID FOREIGN KEY (class_ID) REFERENCES class(ID);

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

---------------------------------------------------------------------
ALTER TABLE registerSubject ADD CONSTRAINT fk_registerSubject_pupilID FOREIGN KEY (pupil_ID) REFERENCES pupil(ID);
ALTER TABLE registerSubject ADD CONSTRAINT fk_registerSubject_subjectID FOREIGN KEY (subject_ID) REFERENCES subject(ID);
---------------------------------------------------------------------
ALTER TABLE creditPupil ADD CONSTRAINT fk_creditPupil_pupilID FOREIGN KEY (pupilID) REFERENCES pupil(ID);
