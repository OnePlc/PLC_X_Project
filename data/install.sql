--
-- Base Table
--
CREATE TABLE `project` (
  `Project_ID` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `project`
  ADD PRIMARY KEY (`Project_ID`);

ALTER TABLE `project`
  MODIFY `Project_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Permissions
--
INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`) VALUES
('add', 'OnePlace\\Project\\Controller\\ProjectController', 'Add', '', '', 0),
('edit', 'OnePlace\\Project\\Controller\\ProjectController', 'Edit', '', '', 0),
('index', 'OnePlace\\Project\\Controller\\ProjectController', 'Index', 'Projects', '/project', 1),
('list', 'OnePlace\\Project\\Controller\\ApiController', 'List', '', '', 1),
('view', 'OnePlace\\Project\\Controller\\ProjectController', 'View', '', '', 0);

--
-- Form
--
INSERT INTO `core_form` (`form_key`, `label`, `entity_class`, `entity_tbl_class`) VALUES
('project-single', 'Project', 'OnePlace\\Project\\Model\\Project', 'OnePlace\\Project\\Model\\ProjectTable');

--
-- Index List
--
INSERT INTO `core_index_table` (`table_name`, `form`, `label`) VALUES
('project-index', 'project-single', 'Project Index');

--
-- Tabs
--
INSERT INTO `core_form_tab` (`Tab_ID`, `form`, `title`, `subtitle`, `icon`, `counter`, `sort_id`, `filter_check`, `filter_value`) VALUES ('project-base', 'project-single', 'Project', 'Base', 'fas fa-cogs', '', '0', '', '');

--
-- Buttons
--
INSERT INTO `core_form_button` (`Button_ID`, `label`, `icon`, `title`, `href`, `class`, `append`, `form`, `mode`, `filter_check`, `filter_value`) VALUES
(NULL, 'Save Project', 'fas fa-save', 'Save Project', '#', 'primary saveForm', '', 'project-single', 'link', '', ''),
(NULL, 'Edit Project', 'fas fa-edit', 'Edit Project', '/project/edit/##ID##', 'primary', '', 'project-view', 'link', '', ''),
(NULL, 'Add Project', 'fas fa-plus', 'Add Project', '/project/add', 'primary', '', 'project-index', 'link', '', '');

--
-- Fields
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_ist`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'text', 'Name', 'label', 'project-base', 'project-single', 'col-md-3', '/project/view/##ID##', '', 0, 1, 0, '', '', '');

--
-- Default Widgets
--
INSERT INTO `core_widget` (`Widget_ID`, `widget_name`, `label`, `permission`) VALUES
(NULL, 'project_dailystats', 'Project - Daily Stats', 'index-Project\\Controller\\ProjectController'),
(NULL, 'project_taginfo', 'Project - Tag Info', 'index-Project\\Controller\\ProjectController');

COMMIT;