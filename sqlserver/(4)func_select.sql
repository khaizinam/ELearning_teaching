/*********************************/
/*                               */
/*            QUERY              */
/*                               */
/*********************************/


CREATE FUNCTION classList(@subject_ID VARCHAR(10))
RETURNS TABLE
RETURN
(
		SELECT class.name as ten_nhom_lop,class.start_at,class.end_at,class.room,lecturer.full_name as giang_vien_phu_trach
		FROM ((class 
		INNER JOIN lecturer ON class.lecturer_ID = lecturer.ID)
		INNER JOIN subject ON class.subject_ID = subject.ID)
		WHERE subject_ID = @subject_ID
)
GO

CREATE FUNCTION pupilList(@class_ID VARCHAR(10))
RETURNS TABLE
RETURN
(
		SELECT pupil.full_name as full_name,pupil.ID as MSSV , pupil.Email,pupil.class,falcuty.name as falcuty
		FROM (((studentList 
		INNER JOIN class
		ON studentList.class_ID = class.ID)
		INNER JOIN pupil
		ON studentList.pupil_ID = pupil.ID)
		INNER JOIN falcuty
		ON pupil.falcuty_ID = falcuty.ID)
		WHERE class_ID = @class_ID
)
GO



CREATE FUNCTION registerList(@pupil_ID VARCHAR(10))
RETURNS TABLE
RETURN
(
	SELECT subject.name as subject,subject.num_credit
	FROM ((registerSubject 
	INNER JOIN pupil ON registerSubject.pupil_ID = pupil.ID)
	INNER JOIN subject ON registerSubject.subject_ID = subject.ID)
	WHERE pupil_ID = @pupil_ID
)
GO


select * from classList('CO2004')
select * from pupilList('1001')

SELECT class.name as class, lecturer.full_name,lecturer.ID,lecturer.Email,lecturer.p_number ,falcuty.name as falcuty
FROM (((lecturerList 
INNER JOIN class 
ON lecturerList.class_ID = class.ID)
INNER JOIN lecturer 
ON lecturerList.lecturer_ID = lecturer.ID)
INNER JOIN falcuty 
ON lecturer.falcuty_ID = falcuty.ID);


SELECT lecturer.full_name,lecturer.ID,lecturer.Email,lecturer.p_number ,falcuty.name
FROM lecturer INNER JOIN falcuty 
ON lecturer.falcuty_ID = falcuty.ID


-----------GOI danh sach SV-------------------
SELECT pupil.full_name as full_name, pupil.ID as MSSV,pupil.Email , pupil.class,pupil.status as tinh_trang_hoc,creditPupil.numCredit,falcuty.name as falcuty
FROM ((pupil 
INNER JOIN falcuty 
ON pupil.falcuty_ID = falcuty.ID)
INNER JOIN creditPupil 
ON pupil.ID = creditPupil.pupilID);