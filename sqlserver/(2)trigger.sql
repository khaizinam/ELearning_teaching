
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
	delete from falcuty Where ID = (SELECT deleted.ID FROM deleted);
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
	delete from assignsTextBook  Where textbookID = (SELECT deleted.ID FROM deleted);
	delete from useTextbook  Where textbookID = (SELECT deleted.ID FROM deleted);
	delete from publishes  Where textbookID = (SELECT deleted.ID FROM deleted);
	delete from writes Where textbookID = (SELECT deleted.ID FROM deleted);
	delete from text_book Where ID = (SELECT deleted.ID FROM deleted);
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







