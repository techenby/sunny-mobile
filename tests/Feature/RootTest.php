<?php

test('unauthenticated users are redirected to splash', function (): void {
    $this->get('/')->assertRedirect(route('splash'));
});
