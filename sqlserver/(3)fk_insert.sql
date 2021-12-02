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
('5012345', N'Nguyễn Hữu Luân','1'),('5012478',N'Trần Thanh Thuyết','2')
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
('47','210457','CO2004')

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