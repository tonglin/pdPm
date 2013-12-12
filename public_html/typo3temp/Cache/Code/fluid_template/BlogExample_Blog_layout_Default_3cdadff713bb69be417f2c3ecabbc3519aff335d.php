<?php
class FluidCache_BlogExample_Blog_layout_Default_3cdadff713bb69be417f2c3ecabbc3519aff335d extends \TYPO3\CMS\Fluid\Core\Compiler\AbstractCompiledTemplate {

public function getVariableContainer() {
	// TODO
	return new \TYPO3\CMS\Fluid\Core\ViewHelper\TemplateVariableContainer();
}
public function getLayoutName(\TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {

return NULL;
}
public function hasLayout() {
return FALSE;
}

/**
 * Main Render function
 */
public function render(\TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface $renderingContext) {
$self = $this;
$output0 = '';

$output0 .= '<div class="tx-blogexample">
	';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\FlashMessagesViewHelper
$arguments1 = array();
$arguments1['renderMode'] = 'div';
$arguments1['additionalAttributes'] = NULL;
$arguments1['class'] = NULL;
$arguments1['dir'] = NULL;
$arguments1['id'] = NULL;
$arguments1['lang'] = NULL;
$arguments1['style'] = NULL;
$arguments1['title'] = NULL;
$arguments1['accesskey'] = NULL;
$arguments1['tabindex'] = NULL;
$arguments1['onclick'] = NULL;
$renderChildrenClosure2 = function() use ($renderingContext, $self) {
return NULL;
};
$viewHelper3 = $self->getViewHelper('$viewHelper3', $renderingContext, 'TYPO3\CMS\Fluid\ViewHelpers\FlashMessagesViewHelper');
$viewHelper3->setArguments($arguments1);
$viewHelper3->setRenderingContext($renderingContext);
$viewHelper3->setRenderChildrenClosure($renderChildrenClosure2);
// End of ViewHelper TYPO3\CMS\Fluid\ViewHelpers\FlashMessagesViewHelper

$output0 .= $viewHelper3->initializeArgumentsAndRender();

$output0 .= '
	';
// Rendering ViewHelper TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper
$arguments4 = array();
$arguments4['section'] = 'content';
$arguments4['partial'] = NULL;
$arguments4['arguments'] = array (
);
$arguments4['optional'] = false;
$renderChildrenClosure5 = function() use ($renderingContext, $self) {
return NULL;
};
$viewHelper6 = $self->getViewHelper('$viewHelper6', $renderingContext, 'TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper');
$viewHelper6->setArguments($arguments4);
$viewHelper6->setRenderingContext($renderingContext);
$viewHelper6->setRenderChildrenClosure($renderChildrenClosure5);
// End of ViewHelper TYPO3\CMS\Fluid\ViewHelpers\RenderViewHelper

$output0 .= $viewHelper6->initializeArgumentsAndRender();

$output0 .= '
	<div class="hr"><hr /></div>
	<p class="tx-blogexample-copyright">&copy; TYPO3 Association</p>
</div>';

return $output0;
}


}
#1386838054    2504      