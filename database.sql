create database students;
create user 'ci'@'%' identified by 'ci';
grant all on students.* to 'ci'@'%'
