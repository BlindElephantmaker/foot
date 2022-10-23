<?php

return [
    \App\User\Domain\Exception\EmailIsInvalidException::NAME => 'Электронная почта имеет недопустимый формат',
    \App\User\Domain\Command\Registration\UserAlreadyExistException::NAME => 'Пользователь уже существует',
];
