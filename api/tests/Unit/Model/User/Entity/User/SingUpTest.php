<?php

declare(strict_types=1);

namespace Test\Unit\Model\User\Entity\User;

use Api\Model\User\Entity\User\ConfirmToken;
use Api\Model\User\Entity\User\Email;
use Api\Model\User\Entity\User\UserId;
use Api\Model\User\Entity\User\User;
use PHPUnit\Framework\TestCase;

class SingUpTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = new User(
            $id = UserId::next(),
            $date = new \DateTimeImmutable(),
            $email = new Email('mail@example.com'),
            $hash = 'hash',
            $token = new ConfirmToken('token', $date->modify('+1 day'))
        );

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());
        self::assertEquals($id, $user->getId());
        self::assertEquals($date, $user->getDate());
        self::assertEquals($email, $user->getEmail());
        self::assertEquals($hash, $user->getPasswordHash());
        self::assertEquals($token, $user->getConfirmToken());
    }
}
