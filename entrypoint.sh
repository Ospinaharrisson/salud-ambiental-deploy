#!/bin/bash
set -e

echo "Iniciando Apache..."
exec apache2-foreground
