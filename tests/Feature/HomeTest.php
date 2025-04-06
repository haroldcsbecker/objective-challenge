<?php

test('home page request', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
