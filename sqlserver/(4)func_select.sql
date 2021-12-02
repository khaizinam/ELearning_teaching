


		







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