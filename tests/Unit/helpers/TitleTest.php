<?php

uses()->group('helpers', 'helpers.title');

test('title()', function () {
    expect(title('Reset password'))->toBe('Redefinir senha | '.config('app.name'));
    expect(title(['one', 'two', 'three']))->toBe('one | two | three | '.config('app.name'));
});
