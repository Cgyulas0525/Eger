<<<<<<< HEAD
create table clientquestionnariedetails
=======
create table eger.clientquestionnariedetails
>>>>>>> origin/master
(
	id int auto_increment,
	clientquestionnarie_id int not null,
	questionnariedetail_id int not null,
	reply varchar(500) null,
	description varchar(500) null,
	created_at timestamp null,
	updated_at timestamp null,
	deleted_at timestamp null,
	constraint clientquestionnariedetails_id_uindex
		unique (id)
);

create index clientquestionnariedetails_cq_index
<<<<<<< HEAD
	on clientquestionnariedetails (clientquestionnarie_id, questionnariedetail_id, id);

create index clientquestionnariedetails_qc_index
	on clientquestionnariedetails (questionnariedetail_id, clientquestionnarie_id);

alter table clientquestionnariedetails
=======
	on eger.clientquestionnariedetails (clientquestionnarie_id, questionnariedetail_id, id);

create index clientquestionnariedetails_qc_index
	on eger.clientquestionnariedetails (questionnariedetail_id, clientquestionnarie_id);

alter table eger.clientquestionnariedetails
>>>>>>> origin/master
	add primary key (id);

