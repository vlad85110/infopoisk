-- 1
select *
from cust
where snum = 1001;

-- 2
select city, sname, snum, comm
from sal;

-- 3
select rating, cname
from cust
where city = 'San Jose';

-- 4
select distinct snum
from ord;

-- 5
select sname, city
from sal
where city = 'London'
  and comm > 0.11;

-- 6
select *
from cust
where rating <= 200
  and city != 'Rome';

-- 7
select *
from ord
where odate = '1990-10-03'
   or odate = '1990-10-05';
select *
from ord
where odate in ('1990-10-03', '1990-10-05');

-- 8
select *
from cust
where substr(cname, 1, 1) between 'A' and 'G';

-- 9
select *
from sal
where sname like '%e%';

-- 10
select sum(amt)
from ord
where odate = '1990-10-3';

-- 11
select sum(amt)
from ord
where snum = 1001;

-- 12
select snum, max(amt)
from ord
group by snum
order by snum;

-- 13
select *
from cust
where cname like '%s'
order by cname
limit 1;

-- 14
select avg(comm)
from sal
group by city;

-- 15
select onum, amt * 0.8 as eur, sname, comm
from ord
         join sal s on ord.snum = s.snum
where odate = '1990-10-3';

-- 16
select onum, cname, sname
from ord
         join cust c on ord.cnum = c.cnum
         join sal s on ord.snum = s.snum
where s.city in ('London', 'Rome')
order by onum;

-- 17
select s.sname, sum(amt), comm
from sal s
         join ord o on s.snum = o.snum
where odate < '1990-10-5'
group by s.snum, s.sname
order by s.sname;

-- 18
select onum, amt, cname, sname
from ord
         join cust c on ord.cnum = c.cnum
         join sal s on ord.snum = s.snum
where substr(s.city, 1, 1) between 'L' and 'R'
  and substr(c.city, 1, 1) between 'L' and 'R';

-- 19
select first.cname, second.cname
from cust first,
     cust second
where first.snum = second.snum
  and first.cname < second.cname;

-- 20
select *
from cust
where cust.snum in (select snum from sal where comm < 0.13);

-- 21
create table sal_copy as
select *
from sal;
desc sal;
desc sal_copy;
select *
from sal;
select *
from sal_copy;

-- 22
insert into sal_copy
values (2000, 'Stas', 'Akadem', 1.00),
       (2001, 'Stas2', 'Akadem', 2.00);
select *
from sal_copy;
delete
from sal_copy
where sname = 'Stas2';
select *
from sal_copy;

-- 23
insert into sal_copy
values (2000, 'Stas', 'Akadem', 1.00),
       (2001, 'Stas2', 'Akadem', 2.00);
select *
from sal_copy;
update sal_copy
set comm = comm * 2;
select *
from sal_copy;