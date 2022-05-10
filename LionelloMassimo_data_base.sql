-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 01 2017 г., 10:37
-- Версия сервера: 10.1.10-MariaDB
-- Версия PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lm_data`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`pass`) VALUES
('1234');

-- --------------------------------------------------------

--
-- Структура таблицы `awards`
--

CREATE TABLE `awards` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `trainer` int(11) NOT NULL,
  `message` text NOT NULL,
  `type` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `awards`
--

INSERT INTO `awards` (`id`, `student`, `trainer`, `message`, `type`, `date`) VALUES
(1, 1, 1, 'Lorem ipsum', 3, 1504965669),
(5, 1, 1, 'Lorem ipsum', 7, 1504966584),
(6, 1, 1, 'Lorem ipsum', 6, 1504970115),
(7, 1, 1, 'Lorem ipsum', 8, 1504970122),
(8, 1, 1, 'Lorem ipsum', 4, 1504970128);

-- --------------------------------------------------------

--
-- Структура таблицы `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL DEFAULT '0',
  `trainer` int(11) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `images` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `blogs`
--

INSERT INTO `blogs` (`id`, `student`, `trainer`, `message`, `images`, `date`) VALUES
(1, 0, 1, 'Nullam nec euismod leo, ac tincidunt tellus. Phasellus urna sapien, dapibus a tortor a, hendrerit sagittis nisl. Nulla fringilla tellus consequat urna sagittis, vestibulum feugiat lorem vestibulum.', '[]', 1492355329),
(2, 1, 0, 'Sed a pellentesque risus, a gravida ipsum. Quisque ornare purus vitae velit scelerisque, vitae ornare ipsum euismod. Nunc sollicitudin ultrices convallis. Etiam laoreet porttitor consectetur.', '[]', 1501952119),
(3, 0, 1, 'Nullam nec euismod leo, ac tincidunt tellus.', '[]', 1493062400);

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `programs` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `student`, `programs`) VALUES
(1, 1, '["1"]'),
(2, 2, '[]');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `lesson` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `lesson`, `student`, `type`, `message`, `date`) VALUES
(3, 4, 1, 1, 'Lorem ipsum', 1504884742),
(5, 4, 1, 0, 'Lorem ipsum', 1504884804);

-- --------------------------------------------------------

--
-- Структура таблицы `common`
--

CREATE TABLE `common` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `common`
--

INSERT INTO `common` (`id`, `student`, `program`, `status`) VALUES
(5, 2, 1, '[0,0]');

-- --------------------------------------------------------

--
-- Структура таблицы `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `about` text,
  `trainer` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `promo` varchar(255) DEFAULT NULL,
  `date` int(11) NOT NULL,
  `tasks` text,
  `physical` text,
  `muscle` text NOT NULL,
  `skills` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lessons`
--

INSERT INTO `lessons` (`id`, `name`, `about`, `trainer`, `level`, `promo`, `date`, `tasks`, `physical`, `muscle`, `skills`) VALUES
(1, 'Pellentesque rutrum', 'Pellentesque rutrum ligula ac volutpat efficitur. Sed in pharetra risus. Aenean at lobortis odio. Nulla pretium neque id nisl convallis, ut pellentesque est pharetra.', NULL, 1, '', 1493584965, '["Etiam condimentum viverra hendrerit.","Vivamus facilisis eros eros.","!Fusce dictum commodo sapien, vitae egestas eros aliquet vel."]', '["Lorem","Ipsum"]', '["Nulla"]', '["Duis et sagittis","Maecenas"]'),
(2, 'Etiam condimentum', 'Etiam condimentum viverra hendrerit. Vivamus facilisis eros eros. Fusce dictum commodo sapien, vitae egestas eros aliquet vel. Quisque eu arcu vel arcu tempus porttitor. Nulla facilisi. Curabitur et elit consectetur, varius est id, cursus diam. Integer venenatis leo urna.', NULL, NULL, 'text', 1492262363, '["Proin consequat et nulla a tincidunt.","!Fusce dictum commodo sapien, vitae egestas eros aliquet vel."]', '["Lorem","Morbi"]', '["Nulla"]', '[]'),
(3, 'Praesent eget', 'Praesent eget dui eu nulla auctor lobortis. Cras blandit eu ligula nec sagittis. Mauris semper ante vel turpis eleifend, quis consectetur elit venenatis. Nunc felis enim, aliquam quis convallis a, dapibus vitae nisl.', NULL, NULL, 'text', 1492262466, '["Proin consequat et nulla a tincidunt.","!Fusce dictum commodo sapien, vitae egestas eros aliquet vel."]', '["Morbi"]', '[]', '["Maecenas"]'),
(4, 'xcvxcb', 'bvcbvc', 1, NULL, NULL, 1511732982, '["vcbcvb","!vcbcvbvc"]', '["cvn"]', '["cv"]', '[""]');

-- --------------------------------------------------------

--
-- Структура таблицы `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `trainer` int(11) DEFAULT NULL,
  `student` int(11) DEFAULT NULL,
  `note` text NOT NULL,
  `images` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `lessons` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `personal`
--

INSERT INTO `personal` (`id`, `student`, `lessons`, `status`) VALUES
(1, 1, '["1","4"]', '[1494428254,0]'),
(2, 2, '[]', '[]'),
(3, 4, '[]', '[]');

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `student` int(11) DEFAULT NULL,
  `trainer` int(11) DEFAULT NULL,
  `about` text,
  `date` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`id`, `student`, `trainer`, `about`, `date`, `category`) VALUES
(1, NULL, 1, 'Sed a pellentesque risus, a gravida ipsum.', 1492293112, 0),
(2, 1, NULL, 'Quisque ornare purus vitae velit scelerisque, vitae ornare ipsum euismod.', 1492293163, 2),
(3, 1, 2, NULL, 1492293232, 2),
(4, NULL, 1, 'Quisque ornare purus vitae velit scelerisque, vitae ornare ipsum euismod.', 1492365072, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `private`
--

CREATE TABLE `private` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `trainer` int(11) NOT NULL,
  `from_stud` tinyint(1) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `message` text,
  `images` text NOT NULL,
  `status` int(11) DEFAULT '0',
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `private`
--

INSERT INTO `private` (`id`, `student`, `trainer`, `from_stud`, `type`, `message`, `images`, `status`, `date`) VALUES
(1, 1, 1, 0, 1, 'Vestibulum fermentum nec libero ut commodo. Praesent sed consequat libero, sit amet facilisis erat. Vestibulum gravida bibendum rutrum. Duis arcu turpis, consectetur quis venenatis nec, euismod non est. Nam suscipit tincidunt lobortis. Aliquam quis ipsum justo. Nulla luctus dui non felis dignissim, ut posuere nisi maximus.', '[]', 2, 1492353656),
(2, 1, 1, 1, 0, 'Vestibulum fermentum nec libero ut commodo. Praesent sed consequat libero, sit amet facilisis erat. Vestibulum gravida bibendum rutrum. Duis arcu turpis, consectetur quis venenatis nec, euismod non est. Nam suscipit tincidunt lobortis. Aliquam quis ipsum justo. Nulla luctus dui non felis dignissim, ut posuere nisi maximus.', '[]', 0, 1492353656);

-- --------------------------------------------------------

--
-- Структура таблицы `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `about` varchar(255) DEFAULT NULL,
  `trainer` int(11) NOT NULL,
  `promo` varchar(255) NOT NULL,
  `cost` float NOT NULL,
  `level` int(11) NOT NULL,
  `date` int(11) DEFAULT NULL,
  `lessons` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `programs`
--

INSERT INTO `programs` (`id`, `name`, `about`, `trainer`, `promo`, `cost`, `level`, `date`, `lessons`) VALUES
(1, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque rutrum ligula ac volutpat efficitur. Sed in pharetra risus. Aenean at lobortis odio. Nulla pretium neque id nisl convallis, ut pellentesque est pharetra.', 1, 'link', 200, 1, 1492262295, '["2","3"]'),
(2, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque rutrum ligula ac volutpat efficitur. Sed in pharetra risus. Aenean at lobortis odio. Nulla pretium neque id nisl convallis, ut pellentesque est pharetra.', 2, '', 200, 4, 1492262295, '[]');

-- --------------------------------------------------------

--
-- Структура таблицы `prog_comments`
--

CREATE TABLE `prog_comments` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `recomendations`
--

CREATE TABLE `recomendations` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `trainer` int(11) NOT NULL,
  `program` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `recomendations`
--

INSERT INTO `recomendations` (`id`, `student`, `trainer`, `program`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `trainer` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `student`, `trainer`, `rating`, `review`, `date`) VALUES
(2, 2, 1, 5, '', 1492464446),
(3, 1, 1, 5, 'i love him', 1511738538);

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `main_trainer` int(11) NOT NULL,
  `trainers` text NOT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `status` varchar(255) DEFAULT NULL,
  `about` text NOT NULL,
  `mail` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fb` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `regdate` int(11) NOT NULL,
  `uin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `name`, `surname`, `main_trainer`, `trainers`, `level`, `status`, `about`, `mail`, `phone`, `fb`, `instagram`, `regdate`, `uin`) VALUES
(1, 'Name', 'Surname', 1, '["2"]', 2, 'Vivamus hendrerit scelerisque felis ', '', 'mail@domain.com', '+123 (45) 678 90 12', '', '', 1501113317, '1q'),
(2, 'Firstname', 'Secondname', 2, '["1"]', 1, NULL, '', 'mail@domain.com', '+123 (45) 678 90 12', '', '', 1501123317, '4r');

-- --------------------------------------------------------

--
-- Структура таблицы `targets`
--

CREATE TABLE `targets` (
  `id` int(11) NOT NULL,
  `student` int(11) DEFAULT NULL,
  `trainer` int(11) DEFAULT NULL,
  `physical` text NOT NULL,
  `personal` text NOT NULL,
  `other` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `targets`
--

INSERT INTO `targets` (`id`, `student`, `trainer`, `physical`, `personal`, `other`) VALUES
(1, 1, NULL, '["!Morbi lectus, molestie nec libero eget, interdum est.|25.09.2017"]', '["!Nullam nec euismod leo, ac tincidunt tellus.|25.09.2017"]', '["Praesent sed consequat libero|25.09.2017"]'),
(2, NULL, 1, '', '', '[]'),
(3, NULL, 2, '', '', '[]'),
(4, 2, NULL, '["Vestibulum rhoncus justo in mollis varius.|25.09.2017"]', '[]', '[]'),
(5, 4, NULL, '[]', '[]', '[]');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `trainer` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `students` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `trainer`, `date`, `students`, `status`) VALUES
(1, 'dfgfdg', 1, 1503084000, '["1","2"]', 1),
(2, 'ger', 1, 1504520580, '["1"]', 1),
(3, 'xcvxcc', 1, 1508014800, '["1","2"]', 0),
(5, 'sdcsd', 1, 1508014800, '["1"]', 0),
(6, 'xc', 1, 1508059260, '["1"]', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `about` text NOT NULL,
  `mail` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fb` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `payment` text NOT NULL,
  `regdate` int(11) NOT NULL,
  `uin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `trainers`
--

INSERT INTO `trainers` (`id`, `name`, `surname`, `status`, `about`, `mail`, `phone`, `fb`, `instagram`, `price`, `payment`, `regdate`, `uin`) VALUES
(1, 'Name', 'Trainer', 'Lorem ipsum dolor sit amet, consectetur', '', 'mail@domen.com', '+123 (012) 123 45 67', '', '', 200.07, 'Lorem ipsum dolor sit amet, consectetur', 1501655040, '2w'),
(2, 'Firstname', 'Secondname', 'Morbi ipsum lectus, molestie nec libero eget', '', 'mail@domen.com', '+123 (012) 123 45 67', '', '', 47.5, 'In eget lobortis felis, et semper augue.', 1492355273, '3e');

-- --------------------------------------------------------

--
-- Структура таблицы `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `trainer` int(11) NOT NULL,
  `amount` float NOT NULL,
  `program` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `transactions`
--

INSERT INTO `transactions` (`id`, `student`, `trainer`, `amount`, `program`, `date`) VALUES
(1, 1, 1, 47.5, 0, 1501606250),
(2, 1, 1, 200.07, 1, 1501606883),
(3, 2, 1, 200.07, 0, 1501954875);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `common`
--
ALTER TABLE `common`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `private`
--
ALTER TABLE `private`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `prog_comments`
--
ALTER TABLE `prog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `recomendations`
--
ALTER TABLE `recomendations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `targets`
--
ALTER TABLE `targets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `awards`
--
ALTER TABLE `awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `common`
--
ALTER TABLE `common`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `private`
--
ALTER TABLE `private`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `prog_comments`
--
ALTER TABLE `prog_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `recomendations`
--
ALTER TABLE `recomendations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `targets`
--
ALTER TABLE `targets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
