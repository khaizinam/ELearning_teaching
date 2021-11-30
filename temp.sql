/*********************************/
/*                               */
/*            CLEAR              */
/*                               */
/*********************************/
DROP DATABASE E_LEARNING_TEACHING;  

ALTER TABLE danh_sach_hoc_sinh_trong_lop DROP CONSTRAINT fk_danh_sach_id_sv;


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
CREATE TABLE Giang_Vien (
    ID VARCHAR(10) NOT NULL PRIMARY KEY,
    Ho_ten NVARCHAR(100) NOT NULL,
    Email NVARCHAR(100) NOT NULL,
    SDT VARCHAR(10),
    ID_Khoa VARCHAR(10) NOT NULL,
);
---------------------------------------------------------------------------------------
CREATE TABLE nhom_lop (
    ID VARCHAR(10) NOT NULL PRIMARY KEY,
	ten VARCHAR(10) NOT NULL,
    tiet_bat_dau VARCHAR(5) NOT NULL,
	tiet_ket_thuc VARCHAR(5) NOT NULL,
    Phong_hoc VARCHAR(50) NOT NULL,
	id_giang_vien VARCHAR(10) NOT NULL,
    id_monhoc VARCHAR(10) NOT NULL,
);
----------------------------------------------------------------------
CREATE TABLE Sinh_Vien (
    ID VARCHAR(10) NOT NULL PRIMARY KEY,
    Ho_ten NVARCHAR(100) NOT NULL,
    Lop VARCHAR(100) NOT NULL,
    Email NVARCHAR(200) NOT NULL,
    TT_hoc NVARCHAR(100) NOT NULL,
    khoa_ID VARCHAR(10) NOT NULL,
);
----------------------------------------------------------------------
CREATE TABLE phong_hoc (
    name VARCHAR(50) NOT NULL PRIMARY KEY,
	toa NVARCHAR(100) NOT NULL,
	co_so NVARCHAR(100) NOT NULL,
);
SELECT * FROM phong_hoc;
----------------------------------------------------------------------
CREATE TABLE khoa (
    ID VARCHAR(10) NOT NULL,
    name NVARCHAR(50) NOT NULL,
    PRIMARY KEY (ID)
);

-----------------------------------------------------------------------------------
CREATE TABLE mon_hoc (
    ID VARCHAR(10) NOT NULL PRIMARY KEY,
    Ten_MH NVARCHAR(100) NOT NULL,
    So_TC SMALLINT NOT NULL
);

-----------------------------------------------------------------------------------
CREATE TABLE Giao_Trinh (
    ID VARCHAR(10) NOT NULL,
    Ten_GT VARCHAR(50) NOT NULL,
    Nam_xuatban VARCHAR(4) NOT NULL,
    PRIMARY KEY (ID)
);
CREATE TABLE Tac_Gia (
    ID VARCHAR(10) NOT NULL,
    Ho_Ten VARCHAR(50) NOT NULL,
    PRIMARY KEY (ID)
);
----------------------------------------------------------------------------
CREATE TABLE danh_sach_hoc_sinh_trong_lop (
    ID_SV VARCHAR(10) NOT NULL,
	ID_nhom_lop VARCHAR(10) NOT NULL ,
);
CREATE TABLE giang_vien_quan_li_lop (
    ID_GV VARCHAR(10) NOT NULL,
	ID_nhom_lop VARCHAR(10) NOT NULL ,
);

------------------------------------------------------------------------

CREATE TABLE CT_Dao_Tao (
    Khoa_ID VARCHAR(10) NOT NULL,
    ID_Monhoc VARCHAR(10) NOT NULL,
    PRIMARY KEY (Khoa_ID, ID_Monhoc)
);
---------------------------------------------------------------------------

CREATE TABLE Quanly_Mon_Hoc (
    ID_GV VARCHAR(10) NOT NULL,
    ID_Monhoc VARCHAR(6) NOT NULL,
    ID_GT VARCHAR(10) NOT NULL,
    PRIMARY KEY (ID_GV, ID_Monhoc, ID_GT)
);

------------------------------------------------------------------------------

CREATE TABLE Bien_Soan_GT (
    ID_GT VARCHAR(10) NOT NULL,
    ID_TG VARCHAR(10) NOT NULL,
    PRIMARY KEY (ID_GT, ID_TG)
);

/*********************************/
/*                               */
/*         FOREIGN KEY           */
/*                               */
/*********************************/
ALTER TABLE Giang_Vien ADD CONSTRAINT fk_Giang_Vien_id_khoa FOREIGN KEY (ID_Khoa) REFERENCES Khoa(ID);

-----------------------------------------------------------------------------------------------------------
ALTER TABLE nhom_lop ADD CONSTRAINT fk_nhom_lop_id_monhoc FOREIGN KEY (id_monhoc) REFERENCES mon_hoc(ID);
ALTER TABLE nhom_lop ADD CONSTRAINT fk_nhom_lop_id_giang_vien FOREIGN KEY (id_giang_vien) REFERENCES Giang_Vien(ID);
ALTER TABLE nhom_lop ADD CONSTRAINT fk_nhom_lop_phong_hoc FOREIGN KEY (Phong_hoc) REFERENCES phong_hoc(name);

------------------------------------------------------------------------------------------------------------
ALTER TABLE Sinh_Vien ADD CONSTRAINT fk_Sinh_Vien_khoa_ID FOREIGN KEY (Khoa_ID) REFERENCES Khoa(ID);

--------------------------------------------------------------------
ALTER TABLE danh_sach_hoc_sinh_trong_lop ADD CONSTRAINT fk_danh_sach_id_sv FOREIGN KEY (ID_SV) REFERENCES Sinh_vien(ID);
ALTER TABLE danh_sach_hoc_sinh_trong_lop ADD CONSTRAINT fk_danh_sach_id_lop FOREIGN KEY (ID_nhom_lop) REFERENCES nhom_lop(ID);

--------------------------------------------------------------------
ALTER TABLE giang_vien_quan_li_lop ADD CONSTRAINT fk_quan_li_id_gv FOREIGN KEY (ID_GV) REFERENCES Giang_vien(ID);
ALTER TABLE giang_vien_quan_li_lop ADD CONSTRAINT fk_quan_li_id_lop FOREIGN KEY (ID_nhom_lop) REFERENCES nhom_lop(ID);

--------------------------------------------------------------------
ALTER TABLE CT_Dao_Tao ADD CONSTRAINT fk_CT_Dao_Tao_Khoa_ID FOREIGN KEY (Khoa_ID) REFERENCES Khoa(ID);
ALTER TABLE CT_Dao_Tao ADD CONSTRAINT fk_CT_Dao_Tao_ID_Monhoc FOREIGN KEY (ID_Monhoc) REFERENCES mon_hoc(ID);

--------------------------------------------------------------------
ALTER TABLE Quanly_Mon_Hoc ADD CONSTRAINT fk_Quanly_ID_GV FOREIGN KEY (ID_GV) REFERENCES Giang_vien(ID);
ALTER TABLE Quanly_Mon_Hoc ADD CONSTRAINT fk_Quanly_ID_Monhoc FOREIGN KEY (ID_Monhoc) REFERENCES mon_hoc(ID);
ALTER TABLE Quanly_Mon_Hoc ADD CONSTRAINT fk_Quanly_ID_GT FOREIGN KEY (ID_GT) REFERENCES Giao_Trinh(ID);

---------------------------------------------------------------------
ALTER TABLE Bien_Soan_GT ADD CONSTRAINT fk_Bien_Soan_ID_GT FOREIGN KEY (ID_GT) REFERENCES Giao_Trinh(ID);
ALTER TABLE Bien_Soan_GT ADD CONSTRAINT fk_Bien_Soan_ID_TG FOREIGN KEY (ID_TG) REFERENCES Tac_Gia(ID);
/*********************************/
/*                               */
/*         DATA                  */
/*                               */
/*********************************/
INSERT INTO danh_sach_hoc_sinh_trong_lop
VALUES 
('1913779', '1101' )
--------------------------------------------------------
INSERT INTO phong_hoc 
VALUES 
('202H3', N'H3', N'Co so 1');

----------------------------------------------------------
INSERT INTO khoa 
values
('100174',N'Khoa Học Máy Tinh'),('100175',N'Kĩ Thuật Máy Tính')

----------------------------------------------------------
INSERT INTO mon_hoc 
values
('CO2004',N'Hệ Cơ sở DL','3'),('SP1008',N'Pháp Luat VN đại cương','4')

----------------------------------------------------------
INSERT INTO nhom_lop 
values
('1101','L05','3','6','202H3','10840','CO2004')
----------------------------------------------------------
INSERT INTO giang_vien_quan_li_lop 
values
('10840','1101')

----------------------------------------------------------
INSERT INTO phong_hoc 
VALUES 
('202H3','H3',N'Co so 1');

/*********************************/
/*                               */
/*            QUERY              */
/*                               */
/*********************************/
-----------GOI danh sach GV-------------------
SELECT Giang_Vien.Ho_ten,Giang_Vien.ID,Giang_Vien.Email,Giang_Vien.SDT ,khoa.name
FROM Giang_Vien INNER JOIN khoa 
ON Giang_Vien.ID_Khoa = khoa.ID
WHERE Giang_Vien.ID = 10840;

-----------GOI danh sach SV-------------------
SELECT Sinh_Vien.Ho_ten as full_name, Sinh_Vien.ID as MSSV,Sinh_Vien.Email , Sinh_Vien.Lop,Sinh_Vien.TT_hoc as tinh_trang_hoc,khoa.name as khoa
FROM Sinh_Vien INNER JOIN khoa 
ON Sinh_Vien.khoa_ID = khoa.ID;

-----------GOI danh sach nhom lop-------------------
SELECT nhom_lop.ten as ten_nhom_lop,nhom_lop.tiet_bat_dau,nhom_lop.tiet_ket_thuc,nhom_lop.Phong_hoc,Giang_Vien.Ho_ten as giang_vien_phu_trach,mon_hoc.Ten_MH as mon_hoc
FROM ((nhom_lop 
INNER JOIN Giang_Vien ON nhom_lop.id_giang_vien = Giang_Vien.ID)
INNER JOIN mon_hoc ON nhom_lop.id_monhoc = mon_hoc.ID);

-----------GOI danh sach hoc sinh trong lop-------------------
SELECT nhom_lop.ten as nhom_lop,Sinh_Vien.Ho_ten as full_name,Sinh_Vien.ID as MSSV , Sinh_Vien.Email,Sinh_Vien.Lop,khoa.name as khoa
FROM (((danh_sach_hoc_sinh_trong_lop 
INNER JOIN nhom_lop
ON danh_sach_hoc_sinh_trong_lop.ID_nhom_lop = nhom_lop.ID)
INNER JOIN Sinh_Vien
ON danh_sach_hoc_sinh_trong_lop.ID_SV = Sinh_Vien.ID)
INNER JOIN khoa
ON Sinh_Vien.khoa_ID = khoa.ID);

-----------GOI danh sach GV quan li lop-------------------
SELECT nhom_lop.ten as lop, Giang_Vien.Ho_ten,Giang_Vien.ID,Giang_Vien.Email,Giang_Vien.SDT ,khoa.name as khoa
FROM (((giang_vien_quan_li_lop 
INNER JOIN nhom_lop 
ON giang_vien_quan_li_lop.ID_nhom_lop = nhom_lop.ID)
INNER JOIN Giang_Vien 
ON giang_vien_quan_li_lop.ID_GV = Giang_Vien.ID)
INNER JOIN khoa 
ON Giang_Vien.ID_Khoa = khoa.ID);
