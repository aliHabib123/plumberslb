<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */


    include_once dirname(__FILE__) . '/' . 'components/utils/check_utils.php';
    CheckPHPVersion();
    CheckTemplatesCacheFolderIsExistsAndWritable();


    include_once dirname(__FILE__) . '/' . 'phpgen_settings.php';
    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthorizationStrategy()->ApplyIdentityToConnectionOptions($result);
        return $result;
    }

    
    // OnGlobalBeforePageExecute event handler
    
    
    // OnBeforePageExecute event handler
    
    
    
    class tb_newsPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyConnectionFactory(),
                GetConnectionOptions(),
                '`tb_news`');
            $field = new IntegerField('tb_news_id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('tb_news_title');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('tb_news_details');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new DateField('tb_news_date');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('tb_news_img');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        public function GetPageList()
        {
            $currentPageCaption = $this->GetShortCaption();
            $result = new PageList($this);
            $result->AddGroup($this->RenderText('Default'));
            if (GetCurrentUserGrantForDataSource('banner')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Banner'), 'banner.php', $this->RenderText('Banner'), $currentPageCaption == $this->RenderText('Banner'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('contact')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Contact'), 'contact.php', $this->RenderText('Contact'), $currentPageCaption == $this->RenderText('Contact'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('page')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Page'), 'page.php', $this->RenderText('Page'), $currentPageCaption == $this->RenderText('Page'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('product')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Product'), 'product.php', $this->RenderText('Product'), $currentPageCaption == $this->RenderText('Product'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('project')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Project'), 'project.php', $this->RenderText('Project'), $currentPageCaption == $this->RenderText('Project'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('section')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Section'), 'section.php', $this->RenderText('Section'), $currentPageCaption == $this->RenderText('Section'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('service')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Service'), 'service.php', $this->RenderText('Service'), $currentPageCaption == $this->RenderText('Service'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('social')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Social'), 'social.php', $this->RenderText('Social'), $currentPageCaption == $this->RenderText('Social'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('subscriber')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Subscriber'), 'subscriber.php', $this->RenderText('Subscriber'), $currentPageCaption == $this->RenderText('Subscriber'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('tb_news')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Tb News'), 'tb_news.php', $this->RenderText('Tb News'), $currentPageCaption == $this->RenderText('Tb News'), false, $this->RenderText('Default')));
            
            if ( HasAdminPage() && GetApplication()->HasAdminGrantForCurrentUser() ) {
              $result->AddGroup('Admin area');
              $result->AddPage(new PageLink($this->GetLocalizerCaptions()->GetMessageString('AdminPage'), 'phpgen_admin.php', $this->GetLocalizerCaptions()->GetMessageString('AdminPage'), false, false, 'Admin area'));
            }
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function CreateGridSearchControl(Grid $grid)
        {
            $grid->UseFilter = true;
            $grid->SearchControl = new SimpleSearch('tb_newsssearch', $this->dataset,
                array('tb_news_id', 'tb_news_title', 'tb_news_details', 'tb_news_date', 'tb_news_img'),
                array($this->RenderText('Tb News Id'), $this->RenderText('Tb News Title'), $this->RenderText('Tb News Details'), $this->RenderText('Tb News Date'), $this->RenderText('Tb News Img')),
                array(
                    '=' => $this->GetLocalizerCaptions()->GetMessageString('equals'),
                    '<>' => $this->GetLocalizerCaptions()->GetMessageString('doesNotEquals'),
                    '<' => $this->GetLocalizerCaptions()->GetMessageString('isLessThan'),
                    '<=' => $this->GetLocalizerCaptions()->GetMessageString('isLessThanOrEqualsTo'),
                    '>' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThan'),
                    '>=' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThanOrEqualsTo'),
                    'ILIKE' => $this->GetLocalizerCaptions()->GetMessageString('Like'),
                    'STARTS' => $this->GetLocalizerCaptions()->GetMessageString('StartsWith'),
                    'ENDS' => $this->GetLocalizerCaptions()->GetMessageString('EndsWith'),
                    'CONTAINS' => $this->GetLocalizerCaptions()->GetMessageString('Contains')
                    ), $this->GetLocalizerCaptions(), $this, 'CONTAINS'
                );
        }
    
        protected function CreateGridAdvancedSearchControl(Grid $grid)
        {
            $this->AdvancedSearchControl = new AdvancedSearchControl('tb_newsasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('tb_news_id', $this->RenderText('Tb News Id')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('tb_news_title', $this->RenderText('Tb News Title')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('tb_news_details', $this->RenderText('Tb News Details')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('tb_news_date', $this->RenderText('Tb News Date'), 'Y-m-d H:i:s'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('tb_news_img', $this->RenderText('Tb News Img')));
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actionsBandName = 'actions';
            $grid->AddBandToBegin($actionsBandName, $this->GetLocalizerCaptions()->GetMessageString('Actions'), true);
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/view_action.png');
            }
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/edit_action.png');
                $column->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/delete_action.png');
                $column->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $column->SetAdditionalAttribute('data-modal-delete', 'true');
                $column->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/copy_action.png');
            }
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            //
            // View column for tb_news_id field
            //
            $column = new TextViewColumn('tb_news_id', 'Tb News Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for tb_news_title field
            //
            $column = new TextViewColumn('tb_news_title', 'Tb News Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('tb_newsGrid_tb_news_title_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for tb_news_details field
            //
            $column = new TextViewColumn('tb_news_details', 'Tb News Details', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('tb_newsGrid_tb_news_details_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for tb_news_date field
            //
            $column = new DateTimeViewColumn('tb_news_date', 'Tb News Date', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for tb_news_img field
            //
            $column = new ExternalImageColumn('tb_news_img', 'Tb News Img', $this->dataset, '');
            $column->SetSourcePrefix('');
            $column->SetSourceSuffix('');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for tb_news_id field
            //
            $column = new TextViewColumn('tb_news_id', 'Tb News Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for tb_news_title field
            //
            $column = new TextViewColumn('tb_news_title', 'Tb News Title', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('tb_newsGrid_tb_news_title_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for tb_news_details field
            //
            $column = new TextViewColumn('tb_news_details', 'Tb News Details', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('tb_newsGrid_tb_news_details_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for tb_news_date field
            //
            $column = new DateTimeViewColumn('tb_news_date', 'Tb News Date', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for tb_news_img field
            //
            $column = new ExternalImageColumn('tb_news_img', 'Tb News Img', $this->dataset, '');
            $column->SetSourcePrefix('');
            $column->SetSourceSuffix('');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for tb_news_title field
            //
            $editor = new TextAreaEdit('tb_news_title_edit', 50, 8);
            $editColumn = new CustomEditColumn('Tb News Title', 'tb_news_title', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for tb_news_details field
            //
            $editor = new HtmlWysiwygEditor('tb_news_details_edit');
            $editor->SetAllowColorControls(true);
            $editColumn = new CustomEditColumn('Tb News Details', 'tb_news_details', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for tb_news_date field
            //
            $editor = new DateTimeEdit('tb_news_date_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Tb News Date', 'tb_news_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for tb_news_img field
            //
            $editor = new ImageUploader('tb_news_img_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('Tb News Img', 'tb_news_img', $editor, $this->dataset, false, false, '../public/uploads/images/');
            $editColumn->OnCustomFileName->AddListener('tb_news_img_GenerateFileName_edit', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for tb_news_title field
            //
            $editor = new TextAreaEdit('tb_news_title_edit', 50, 8);
            $editColumn = new CustomEditColumn('Tb News Title', 'tb_news_title', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for tb_news_details field
            //
            $editor = new HtmlWysiwygEditor('tb_news_details_edit');
            $editor->SetAllowColorControls(true);
            $editColumn = new CustomEditColumn('Tb News Details', 'tb_news_details', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for tb_news_date field
            //
            $editor = new DateTimeEdit('tb_news_date_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Tb News Date', 'tb_news_date', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue($this->RenderText('%CURRENT_DATETIME%'));
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for tb_news_img field
            //
            $editor = new ImageUploader('tb_news_img_edit');
            $editor->SetShowImage(true);
            $editColumn = new UploadFileToFolderColumn('Tb News Img', 'tb_news_img', $editor, $this->dataset, false, false, '../public/uploads/images/');
            $editColumn->OnCustomFileName->AddListener('tb_news_img_GenerateFileName_insert', $this);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $grid->SetShowAddButton(true);
                $grid->SetShowInlineAddButton(false);
            }
            else
            {
                $grid->SetShowInlineAddButton(false);
                $grid->SetShowAddButton(false);
            }
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for tb_news_id field
            //
            $column = new TextViewColumn('tb_news_id', 'Tb News Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for tb_news_title field
            //
            $column = new TextViewColumn('tb_news_title', 'Tb News Title', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for tb_news_details field
            //
            $column = new TextViewColumn('tb_news_details', 'Tb News Details', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for tb_news_date field
            //
            $column = new DateTimeViewColumn('tb_news_date', 'Tb News Date', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for tb_news_img field
            //
            $column = new TextViewColumn('tb_news_img', 'Tb News Img', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for tb_news_id field
            //
            $column = new TextViewColumn('tb_news_id', 'Tb News Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for tb_news_title field
            //
            $column = new TextViewColumn('tb_news_title', 'Tb News Title', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for tb_news_details field
            //
            $column = new TextViewColumn('tb_news_details', 'Tb News Details', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for tb_news_date field
            //
            $column = new DateTimeViewColumn('tb_news_date', 'Tb News Date', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for tb_news_img field
            //
            $column = new TextViewColumn('tb_news_img', 'Tb News Img', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function tb_news_img_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '../public/uploads/images/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function tb_news_img_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), '../public/uploads/images/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
        $filepath = Path::Combine($targetFolder, $filename);
        
        while (file_exists($filepath))
        {
            $filename = FileUtils::AppendFileExtension(rand(), $original_file_extension);
            $filepath = Path::Combine($targetFolder, $filename);
        }
        
        $handled = true;
        }
        public function ShowEditButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasEditGrant($this->GetDataset());
        }
        public function ShowDeleteButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasDeleteGrant($this->GetDataset());
        }
        
        public function GetModalGridDeleteHandler() { return 'tb_news_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'tb_newsGrid');
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
    
            $this->SetShowPageList(true);
            $this->SetHidePageListByDefault(false);
            $this->SetExportToExcelAvailable(true);
            $this->SetExportToWordAvailable(true);
            $this->SetExportToXmlAvailable(true);
            $this->SetExportToCsvAvailable(true);
            $this->SetExportToPdfAvailable(true);
            $this->SetPrinterFriendlyAvailable(true);
            $this->SetSimpleSearchAvailable(true);
            $this->SetAdvancedSearchAvailable(true);
            $this->SetFilterRowAvailable(true);
            $this->SetVisualEffectsEnabled(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
    
            //
            // Http Handlers
            //
            //
            // View column for tb_news_title field
            //
            $column = new TextViewColumn('tb_news_title', 'Tb News Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'tb_newsGrid_tb_news_title_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for tb_news_details field
            //
            $column = new TextViewColumn('tb_news_details', 'Tb News Details', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'tb_newsGrid_tb_news_details_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for tb_news_title field
            //
            $column = new TextViewColumn('tb_news_title', 'Tb News Title', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'tb_newsGrid_tb_news_title_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for tb_news_details field
            //
            $column = new TextViewColumn('tb_news_details', 'Tb News Details', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'tb_newsGrid_tb_news_details_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            return $result;
        }
        
        public function OpenAdvancedSearchByDefault()
        {
            return false;
        }
    
        protected function DoGetGridHeader()
        {
            return '';
        }
    }

    SetUpUserAuthorization(GetApplication());

    try
    {
        $Page = new tb_newsPage("tb_news.php", "tb_news", GetCurrentUserGrantForDataSource("tb_news"), 'UTF-8');
        $Page->SetShortCaption('Tb News');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetCaption('Tb News');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("tb_news"));
        GetApplication()->SetEnableLessRunTimeCompile(GetEnableLessFilesRunTimeCompilation());
        GetApplication()->SetCanUserChangeOwnPassword(
            !function_exists('CanUserChangeOwnPassword') || CanUserChangeOwnPassword());
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e->getMessage());
    }
	
