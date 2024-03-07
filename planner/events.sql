CREATE TABLE `events` (
    `id` int(10) NOT NULL,
    `title` varchar(190) NOT NULL,
    `description` text NOT NULL,
    `start_date` date NOT NULL,
    `end_date` date NOT NULL
);

ALTER TABLE `events`
ADD PRIMARY KEY (`id`);

ALTER TABLE `events`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;