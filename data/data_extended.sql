--
-- Core Form - Project Base Fields
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'textarea', 'Description', 'description', 'project-base', 'project-single', 'col-md-12', '', '', 0, 1, 0, '', '', ''),
(NULL, 'select', 'State', 'state_idfs', 'project-base', 'project-single', 'col-md-3', '', '/tag/api/list/project-single/state', 1, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Project\\Controller\\StateController'),
(NULL, 'select', 'Customer', 'customer_idfs', 'project-base', 'project-single', 'col-md-3', '', '/contact/api/list/0', 0, 1, 0, 'contact-single', 'OnePlace\\Contact\\Model\\ContactTable','add-OnePlace\\Contact\\Controller\\ContactController'),
(NULL, 'select', 'Person responsible', 'resposible_idfs', 'project-base', 'project-single', 'col-md-3', '', '/tag/api/list/project-single/responsible', 0, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable','add-OnePlace\\Project\\Controller\\PersonResponsibleController'),
(NULL, 'date', 'planned Release', 'planned_release', 'project-base', 'project-single', 'col-md-2', '', '', 0, 1, 0, '', '', ''),
(NULL, 'currency', 'Budget', 'budget', 'project-base', 'project-single', 'col-md-1', '', '', 0, 1, 0, '', '', ''),
(NULL, 'multiselect', 'Categories', 'category_idfs', 'project-base', 'project-single', 'col-md-3', '', '/tag/api/list/project-single/category', 1, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable', 'add-OnePlace\\Project\\Controller\\CategoryController'),
(NULL, 'featuredimage', 'Featured Image', 'featured_image', 'project-base', 'project-single', 'col-md-3', '', '', 0, 1, 0, '', '', '');

--
-- permissions
--
INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`) VALUES
('add', 'OnePlace\\Project\\Controller\\CategoryController', 'Add Category', '', '', 0),
('add', 'OnePlace\\Project\\Controller\\PersonResponsibleController', 'Add Person responsible', '', '', 0),
('add', 'OnePlace\\Project\\Controller\\StateController', 'Add State', '', '', 0);


--
-- Custom Tags
--
-- todo: add select before and check if tag exists
--
INSERT INTO `core_tag` (`Tag_ID`, `tag_key`, `tag_label`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(NULL, 'responsible', 'Person Responsible', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00');