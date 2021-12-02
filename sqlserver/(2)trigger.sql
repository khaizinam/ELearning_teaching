
/*********************************/
/*                               */
/*           Triger              */
/*                               */
/*********************************/


create trigger createCredit on pupil AFTER INSERT
AS
begin
	insert into creditPupil (pupilID,numCredit,totalCredit)
	values ((SELECT inserted.ID FROM inserted),'','');
end;
go
---------------------------------------------------------------

create trigger deletePupil on pupil  
INSTEAD OF DELETE 
as
begin
	delete from creditPupil where pupilID = (SELECT deleted.ID FROM deleted);
	delete from studentList  Where pupil_ID = (SELECT deleted.ID FROM deleted);
	delete from registerSubject Where pupil_ID = (SELECT deleted.ID FROM deleted);
	delete from pupil Where ID = (SELECT deleted.ID FROM deleted);
end;
go

create trigger deleteLecturer on lecturer 
INSTEAD OF DELETE
as
begin
	delete from class where lecturer_ID = (SELECT deleted.ID FROM deleted);
	delete from lecturerList  Where lecturer_ID = (SELECT deleted.ID FROM deleted);
	delete from subjectManage Where lecturer_ID = (SELECT deleted.ID FROM deleted);
	delete from lecturer Where ID = (SELECT deleted.ID FROM deleted);
end;
go

create trigger deleteFalcuty on falcuty 
INSTEAD OF DELETE
as
begin
	delete from education where falcuty_ID = (SELECT deleted.ID FROM deleted);
	delete from lecturer  Where falcuty_ID = (SELECT deleted.ID FROM deleted);
	delete from pupil Where falcuty_ID = (SELECT deleted.ID FROM deleted);
	delete from falcuty Where ID = (SELECT deleted.ID FROM deleted);
end;
go

create trigger deleteSubject on subject 
INSTEAD OF DELETE
as
begin
	delete from education where subject_ID = (SELECT deleted.ID FROM deleted);
	delete from subjectManage  Where subject_ID = (SELECT deleted.ID FROM deleted);
	delete from registerSubject Where subject_ID = (SELECT deleted.ID FROM deleted);
	delete from subject Where ID = (SELECT deleted.ID FROM deleted);
end;
go

create trigger deleteTextbook on text_book 
INSTEAD OF DELETE
as
begin
	delete from subjectManage  Where tex_book_ID = (SELECT deleted.ID FROM deleted);
	delete from compilation Where tex_book_ID = (SELECT deleted.ID FROM deleted);
	delete from text_book Where ID = (SELECT deleted.ID FROM deleted);
end;
go
create trigger deleteClass on class 
INSTEAD OF DELETE
as
begin
	delete from studentList  Where class_ID = (SELECT deleted.ID FROM deleted);
	delete from lecturerList Where class_ID = (SELECT deleted.ID FROM deleted);
	delete from class Where ID = (SELECT deleted.ID FROM deleted);
end;
go
create trigger deleteAuthor on author 
INSTEAD OF DELETE
as
begin
	delete from compilation  Where author_ID = (SELECT deleted.ID FROM deleted);
	delete from author Where ID = (SELECT deleted.ID FROM deleted);
end;
go
------------------------------------------------------------------------------







