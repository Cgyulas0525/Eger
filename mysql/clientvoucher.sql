create table clientvoucher
(
	id int auto_increment,
	client_id int not null,
	voucher_id int not null,
	posted date not null,
	used date null,
	description varchar(500) null,
	created_at timestamp null,
	updated_at timestamp null,
	deleted_at timestamp null,
	constraint clientvoucher_id_uindex
		unique (id)
);

create index clientvoucher_client_id_voucher_id_index
	on clientvouchers (client_id, voucher_id);

create index clientvoucher_used_client_id_voucher_id_index
	on clientvouchers (used, client_id, voucher_id);

create index clientvoucher_used_voucher_id_client_id_index
	on clientvouchers (used, voucher_id, client_id);

create index clientvoucher_voucher_id_client_id_index
	on clientvouchers (voucher_id, client_id);

alter table clientvouchers
	add primary key (id);

