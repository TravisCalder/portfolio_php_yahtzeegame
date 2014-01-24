<?php
namespace crias\testing;
use Exception;

trait ExceptionTesting {
  abstract function assertEquals($expected, $actual);
  abstract function fail($message);

  public function assertException(Exception $expected, $code) {
    try {
      $code();
    } catch (Exception $actual) {
      $this->assertEquals($expected, $actual);
      return;
    }
    $message = $expected->getMessage();
    $this->fail("Expected exception '$message' was not raised.");
  }
}
