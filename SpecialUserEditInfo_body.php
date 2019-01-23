<?php
class SpecialUserEditInfo extends SpecialPage {
    function __construct(){
        parent::__construct('UserEditInfo');
    }

    function execute( $par ) {
        $this->setHeaders('usereditinfo');

        $request = $this->getRequest();
        $output = $this->getOutput();
        
        $user_name = $request->getText('username', '');

        $a = [
            'username' => [
                'name' => 'username',
                'label-message' => 'usereditinfo-username',
                'type' => 'text',
                'default' => $user_name,
            ]
        ];

        $htmlForm = HTMLForm::factory( 'ooui', $a, $this->getContext() );
        $htmlForm
            ->setMethod( 'get' )
            ->setSubmitText( 'Get EditInfo' )
            ->setWrapperLegendMsg( 'usereditinfo_legend' )
            ->prepareForm()
            ->displayForm( false );
        
        if( $user_name !== '' ){
            $user_name = User::newFromName( $user_name );
            $edits = $user_name->getEditCount() ;
            $output->addHtml('<h1>Edit Counts</h1>');
            $output->addHtml('<p> The User '. $user_name . ' has <strong>'. $edits . '</strong> edit count.' );
        }
    }
}