output "frontend_public_ip" {
  description = "Public IP of the frontend instance"
  value       = aws_instance.frontend.public_ip
}

output "backend_private_ip" {
  description = "Private IP of the backend instance"
  value       = aws_instance.backend.private_ip
}

output "ssh_private_key" {
  description = "Private key to access the instances"
  value       = tls_private_key.ec2_key.private_key_pem
  sensitive   = true
}

output "db_endpoint" {
  description = "Endpoint of the PostgreSQL database"
  value       = aws_db_instance.postgres.address
}