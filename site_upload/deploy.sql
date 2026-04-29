-- =============================================
-- GCOMP.GE Social Module - Deploy SQL
-- =============================================

CREATE TABLE IF NOT EXISTS `oc_gcomp_social` (
  `social_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `label_ka` varchar(255) NOT NULL,
  `label_en` varchar(255) NOT NULL,
  `label_ru` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(500) NOT NULL DEFAULT '',
  `phone` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `color` varchar(20) NOT NULL DEFAULT '#888',
  `position` enum('header','floating','both') NOT NULL DEFAULT 'both',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`social_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default rows (matching current site)
INSERT INTO `oc_gcomp_social` (`type`, `label_ka`, `label_en`, `label_ru`, `icon`, `url`, `phone`, `email`, `color`, `position`, `sort_order`, `status`) VALUES
('callback',  'ზარის მოთხოვნა', 'Request a call',  'Заказать звонок', 'fa-phone',          '',                          '557142814',     '', '#e74c3c', 'both', 1, 1),
('messenger', 'Messenger',       'Messenger',       'Messenger',       'fa-facebook-messenger', 'https://m.me/gcomp.ge', '',              '', '#0084ff', 'both', 2, 1),
('telegram',  'Telegram',        'Telegram',        'Telegram',        'fa-telegram',       'https://t.me/gcomp_ge',     '',              '', '#0088cc', 'both', 3, 1),
('viber',     'Viber',           'Viber',           'Viber',           'fa-viber',          'viber://chat?number=%2B995557142814', '',    '', '#7360f2', 'both', 4, 1),
('whatsapp',  'WhatsApp',        'WhatsApp',        'WhatsApp',        'fa-whatsapp',       'https://wa.me/995557142814','',              '', '#25d366', 'header', 5, 1),
('email',     'Write to mail',   'Write to mail',   'Написать на почту', 'fa-envelope',     '',                          '',  'info@gcomp.ge', '#e74c3c', 'floating', 6, 1);

-- Module settings
INSERT IGNORE INTO `oc_setting` (`store_id`, `code`, `key`, `value`, `serialized`) VALUES
(0, 'module_gcomp_social', 'module_gcomp_social_status', '1', 0);
