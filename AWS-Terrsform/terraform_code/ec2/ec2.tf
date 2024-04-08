provider "aws" {
  region = "us-east-1"
}

resource "aws_instance" "wms-server" {
  count                  = 2
  ami                    = "ami-0440d3b780d96b29d"
  instance_type          = "t2.micro"
  key_name               = "WMS"
  vpc_security_group_ids = ["sg-06d360c17eac7ef1b"]
}
