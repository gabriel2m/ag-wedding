<?php

uses()->group('helpers', 'helpers.title');

test('title()', function () {
    expect(title(['Reset password']))->toBe(trans('Reset password').' | '.config('app.name'));
    expect(title(['one', 'two', 'three']))->toBe('one | two | three | '.config('app.name'));
    expect(title([]))->toBe(config('app.name'));
});
