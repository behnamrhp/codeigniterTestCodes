<?php
echo $this->extend('templates/header');
$this->section('footer');

echo $this->include('templates/footer');

$this->endSection('footer');