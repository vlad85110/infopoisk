
-- 1.1
select * from ord;
select * from cust where  rating > 100;
select distinct city from sal;

-- 1.2
desc cust;
desc ord;
desc sal;


-- 2.1
SELECT * FROM cust WHERE NOT city = 'San Jose' OR rating > 200;
-- Вывод всех столбцов таблицы заказчиков, чей город не Сан Хосе либо чей рейтинг выше 200
-- Его так же можно переформулировать, отрицание первого условия на != в нем
SELECT * FROM cust WHERE city != 'San Jose' OR rating > 200;


SELECT * FROM cust WHERE NOT (city = 'San Jose' OR rating > 200);
-- Переформулируем запрос по закону де моргана
SELECT * FROM cust WHERE city != 'San Jose' AND rating <= 200;
-- Получим тех заказчиков, чей город не Сан хосе и чей рейтинг меньше, либо равен 200


-- 2.2
SELECT * FROM sal WHERE city IN ('Barcelona', 'London');
-- Значений city в этом запросе всего два, такой запрос можно переформулировать через =
SELECT * FROM sal WHERE city = 'Barcelona' OR city = 'London';

-- 2.3
SELECT * FROM sal WHERE comm BETWEEN .12 AND .10;
-- Если поменять границы диапазона местами, получим пустой вывод вместо того, который был


-- 2.4
SELECT * FROM cust WHERE cname LIKE '%s';
-- Выведите сведения обо всех покупателях, чьи имена заканчиваются на s


-- 3.1
SELECT MAX(city) FROM sal;
SELECT MIN(city) FROM sal;
-- Данные запросы выводят самый первый и самый последний город в лексикографическом порядке

SELECT sal.city from sal order by city;
-- Если выполнить данный запрос то первым кортежом в выводе будет MIN(city),
-- а последним MAX(city)


-- 3.2
SELECT snum, MAX(amt) FROM ord GROUP BY snum;
-- Первый запрос выведет максимальную сумму заказа для каждого продавца

SELECT snum, odate, MAX(amt) FROM ord GROUP BY snum, odate;
-- Для удобства можно еще отсортировать по snum и odate
SELECT snum, odate, MAX(amt) FROM ord GROUP BY snum, odate order by snum, odate;
-- Теперь по порядку для каждого продавца выводится его максимальная сумма заказа
-- для каждого из дней

-- 3.3

SELECT amt, odate, cnum FROM ord ORDER BY cnum DESC;
-- В этом запросе кортежи будут отсортированны по id заказчика в убывающем порядке

SELECT amt, odate, cnum FROM ord ORDER BY cnum DESC, 1 DESC;
-- Тут же кортежи будут еще отсортированы по первому столбцу в таблице, а именно onum,
-- но проекция его не зацепляет, поэтому он сам выводиться не будет

-- 4.1
SELECT cname, sname, sal.city  FROM sal, cust WHERE sal.city = cust.city;
-- Изменим этот запрос, исключив London из списка городов. Для этого используем подзапрос
SELECT * FROM (SELECT cname, sname, sal.city  FROM sal, cust WHERE sal.city = cust.city)
as csc WHERE city != 'London';

-- Сделаем то же самое, дополнив условие
SELECT cname, sname, sal.city  FROM sal, cust WHERE sal.city = cust.city
and sal.city != 'London';

-- 4.2
SELECT first.cname, second.cname, first.rating
FROM cust first, cust second
WHERE first.rating = second.rating;

SELECT first.cname, second.cname, first.rating
FROM cust first, cust second
WHERE first.rating = second.rating
AND first.cname < second.cname;
-- Первый запрос выводит одну пару два раза - (А, Б) и (Б, А).
-- Дополнительное условие убирает повторение пар и убирает пары типа (А, А),
-- когда человек в паре сам с собой

-- 4.3
SELECT b.cnum, b.cname
FROM cust a, cust b
WHERE a.snum = 1002
  AND b.city = a.city;
-- Этот запрос выберет всех покупателей, живущих в тех же городах, что и покупатели продавца Serres.
-- Запрос ищет совпадения по городу между покупателями продавца Serres
-- (представленными как a) и другими покупателями (b).


-- 5.1
select * from ord where cnum = (select cnum from cust where cname = 'Grass');
-- Сначала получим id по имени, а затем найдем заказ по этому id


-- 5.2
select * from ord where cnum in (select cnum from cust where cname = 'Grass');
-- Аналогичный запрос с оператором in вместо =



-- 6.1
CREATE TABLE mytab (col1 INT(3) NOT NULL, col2 VARCHAR (10) NOT NULL,col3 DATE);
DROP TABLE mytab;
CREATE TABLE tab1 (col1 INT(3) NOT NULL, col2 VARCHAR (10) NOT NULL,col3 DATE);


-- 6.2
CREATE TABLE newtab AS select snum, sname from sal;
desc newtab;
select * from newtab;


-- 6.3
ALTER TABLE newtab modify sname varchar(256);
ALTER TABLE newtab add col1 int;
alter table newtab add col2 varchar(2);
desc newtab;


-- 7.1
create table t1(id int, name varchar(15));
create table t2(id int, name varchar(15));

insert into t1 values (1, 'name'),(2, 'name');
insert into t2 select * from t1;

select * from t1;
select * from t2;

-- 7.2
truncate table t1;
select * from t1;

create table tab2 as select * from sal;
select * from tab2;
delete from tab2 where city = 'San Jose';
select * from tab2;

-- 7.3
create table mysal as select * from sal;
select * from mysal;
update mysal set comm = comm + 0.01 where city = 'London';
select * from mysal;