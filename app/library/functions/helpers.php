<?php 

function base_path()
{
  return dirname(__FILE__, 4);
}

function view(string $path, array $data = [])
{
  if (!empty($data)) {
    extract($data);
  }
  require base_path() . DIRECTORY_SEPARATOR . $path;
}