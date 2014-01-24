<?php

interface Option {
  public function isEmpty();
  public function isDefined();
  public function map($fn);
  public function getOrElse($default);
}
