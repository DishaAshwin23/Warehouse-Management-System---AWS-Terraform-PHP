-- Create the schema if not exists
CREATE SCHEMA IF NOT EXISTS stockgudang;
USE stockgudang;

-- Table: m_item
CREATE TABLE `stockgudang`.`m_item` (
  `item_id` INT(11) NOT NULL AUTO_INCREMENT,
  `item_code` VARCHAR(20) NOT NULL,
  `workshop_name` VARCHAR(50) NOT NULL,
  `item_name` VARCHAR(100) NOT NULL,
  `item_quantity` INT(11) NOT NULL,
  `item_satuan` VARCHAR(55) NOT NULL,
  `item_date` VARCHAR(45) NOT NULL,
  `item_price` INT(11) NOT NULL,
  `information` VARCHAR(50) NOT NULL,
  `item_supplier_id` INT(11) NOT NULL,
  PRIMARY KEY (`item_id`));

-- Insert data into m_item table
INSERT INTO m_item (item_id, item_code, workshop_name, item_name, item_quantity, item_satuan, item_date, item_price, information, item_supplier_id)
VALUES
(20, 'MC-811242', 'PAK UJANG', 'SELANG POWER STEERING PS190', 5, 'kg', '2023-08-10', 150000000, 'SERVIS', 0),
(24, 'HKB003', 'AUTO2000', 'SELANG POWER STEERING PS190', 4, 'kg', '2023-08-10', 99000000, 'SERVIS', 0),
(25, '018051', 'KASDI', 'FILTER OLI O-18051', 4, 'liter', '2023-08-14', 880000, 'SERVIS', 0);

-- Table: m_mutasi
CREATE TABLE `stockgudang`.`m_mutasi` (
  `mutasi_id` INT(11) NOT NULL AUTO_INCREMENT,
  `mutasi_item_id` INT(11) NOT NULL,
  `mutasi_item_code` VARCHAR(50) NOT NULL,
  `mutasi_bengkel` VARCHAR(50) NOT NULL,
  `mutasi_barang` VARCHAR(50) NOT NULL,
  `mutasi_date` DATE NOT NULL,
  `mutasi_quantity` INT(11) NOT NULL,
  `mutasi_satuan` VARCHAR(55) NOT NULL,
  `mutasi_price` INT(11) NOT NULL,
  `mutasi_keterangan` VARCHAR(50) NOT NULL,
  PRIMARY KEY (mutasi_id));

-- Insert data into m_mutasi table
INSERT INTO m_mutasi (mutasi_id, mutasi_item_id, mutasi_item_code, mutasi_bengkel, mutasi_barang, mutasi_date, mutasi_quantity, mutasi_satuan, mutasi_price, mutasi_keterangan)
VALUES
(28, 24, 'HKB003', 'AUTO2000', 'SELANG POWER STEERING', '2023-08-15', 1, 'kg', 99000000, 'SERVIS'),
(29, 24, 'HKB003', 'AUTO2000', 'SELANG POWER STEERING', '2023-08-15', 1, 'kg', 99000000, 'SERVIS'),
(30, 25, '018051', 'KASDI', 'FILTER OLI O-18051', '2023-08-15', 1, 'kg', 880000, 'SERVIS');

-- Table: m_supplier
CREATE TABLE `stockgudang`.`m_supplier` (
  `supplier_id` INT(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` VARCHAR(30) NOT NULL,
  `supplier_contact` VARCHAR(100) NOT NULL,
  `supplier_address` VARCHAR(200) NOT NULL,
  PRIMARY KEY (supplier_id));

-- Insert data into m_supplier table
INSERT INTO m_supplier (supplier_id, supplier_name, supplier_contact, supplier_address)
VALUES (6, 'PAK UJANG', 'WA: 008123456789', 'JALAN YANG LURUS');

-- Add primary key constraint to m_item table
ALTER TABLE m_item
  ADD PRIMARY KEY (item_id);

-- Add primary key constraint to m_mutasi table
ALTER TABLE m_mutasi
  ADD PRIMARY KEY (mutasi_id);

-- Add primary key constraint to m_supplier table
ALTER TABLE m_supplier
  ADD PRIMARY KEY (supplier_id);

-- Add auto-increment to item_id column in m_item table
ALTER TABLE m_item
  MODIFY item_id INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

-- Add auto-increment to mutasi_id column in m_mutasi table
ALTER TABLE m_mutasi
  MODIFY mutasi_id INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
