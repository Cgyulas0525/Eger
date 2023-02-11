create table eger.settlements
(
	id int auto_increment,
	name varchar(100) not null,
	postcode int not null,
	description varchar(500) null,
	created_at timestamp null,
	updated_at timestamp null,
	deleted_at timestamp null,
	constraint settlements_id_uindex
		unique (id)
);

create index settlements_name_postcode_id_index
	on eger.settlements (name, postcode, id);

create index settlements_postcode_name_id_index
	on eger.settlements (postcode, name, id);

alter table eger.settlements
	add primary key (id);

