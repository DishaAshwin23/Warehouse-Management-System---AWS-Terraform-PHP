provider "aws" {
  region = "us-east-1"
}

resource "aws_db_instance" "wmsdbs" {
  allocated_storage    = 20
  storage_type         = "gp2"
  engine               = "mysql"
  engine_version       = "8.0.35"
  instance_class       = "db.t2.micro"
  identifier           = "wmsdb"
  username             = "admin"
  password             = "sqladmin"
  publicly_accessible  = true
}
