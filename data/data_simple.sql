--
-- Core Form - Project Base Fields
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'textarea', 'Description', 'description', 'project-base', 'project-single', 'col-md-12', '', '', 0, 1, 0, '', '', ''),
(NULL, 'multiselect', 'Categories', 'category_idfs', 'project-base', 'project-single', 'col-md-3', '', '/tag/api/list/project-single/category', 1, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable', 'add-OnePlace\\Project\\Controller\\CategoryController'),
(NULL, 'select', 'State', 'state_idfs', 'project-base', 'project-single', 'col-md-3', '', '/tag/api/list/project-single/state', 1, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Project\\Controller\\StateController'),
(NULL, 'featuredimage', 'Featured Image', 'featured_image', 'project-base', 'project-single', 'col-md-3', '', '', 0, 1, 0, '', '', '');

--
-- permissions
--
INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`) VALUES
('add', 'OnePlace\\Project\\Controller\\CategoryController', 'Add Category', '', '', 0),
('add', 'OnePlace\\Project\\Controller\\StateController', 'Add State', '', '', 0);

