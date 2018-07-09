<?php
session_start(); //aktuelle Session erst herausfinden,
session_destroy(); //damit man sie beenden kann & Weiterleitung auf...
header('Location: cover.html');