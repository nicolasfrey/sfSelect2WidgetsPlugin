<?php

/**
 * This widget is designed to generate more user friendly autocomplete widgets.
 *
 * @package     symfony
 * @subpackage  widget
 * @link        https://github.com/19Gerhard85/sfSelect2WidgetsPlugin
 * @author      Ing. Gerhard Schranz <g.schranz@bgcc.at>
 * @version     0.1 2013-03-11
 */
class sfWidgetFormSelect2Autocompleter extends sfWidgetFormChoice {
    /**
     * Configures the current widget.
     *
     * Available options:
     *
     *  * url:            The URL to call to get the choices to use (required)
     *  * config:         A JavaScript array that configures the JQuery autocompleter widget
     *  * value_callback: A callback that converts the value before it is displayed
     *
     * @param array $options     An array of options
     * @param array $attributes  An array of default HTML attributes
     *
     * @see sfWidgetForm
     */
    protected function configure($options = array(), $attributes = array()) {
        $this->addRequiredOption('url');
        $this->addOption('result_callback');
        $this->addOption('value_callback');
        $this->addOption('culture', sfContext::getInstance()->getUser()->getCulture());
        $this->addOption('width', sfConfig::get('sf_sfSelect2Widgets_width'));
        $this->addOption('config', '{ }');
        $this->addOption('minimumInputLength', 2);
        $this->addOption('placeholder', '');
        $this->addOption('allowClear', true);
        $this->addOption('formatSelection', 'defaultFormatResult');
        $this->addOption('formatResult', 'defaultFormatResult');
        $this->addOption('formatNoMatches', 'defaultFormatNoMatches');
        $this->addOption('formatInputTooShort', 'defaultFormatInputTooShort');

        $this->addOption('choices');

        parent::configure($options, $attributes);
    }

    /**
     * @param  string $name        The element name
     * @param  string $value       The date displayed in this widget
     * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
     * @param  array  $errors      An array of errors for the field
     *
     * @return string An HTML tag string
     *
     * @see sfWidgetForm
     */
    public function render($name, $value = null, $attributes = array(), $errors = array()) {
        $visible_value = escape_javascript($this->getOption('value_callback') ? call_user_func($this->getOption('value_callback'), $value) : $value);

        $id = $this->generateId($name);
        $setDefaultValue = "";
        if ($value !== null) {
            $setDefaultValue = "jQuery('#{$id}').select2({ data: [{id: '{$value}',text: '{$visible_value}'}]});";
        }

        $return = //$this->renderTag('input', array('type'  => 'hidden','name'  => $name,'value' => $visible_value)).
        parent::render($name, $value, $attributes, $errors);

        $return .= sprintf(<<<EOF
<script type="text/javascript">
function defaultFormatResult(item)
{
    return item;
}

function defaultFormatNoMatches(term)
{
    return 'Keine Ergebnisse gefunden.';
}

function defaultFormatInputTooShort(term, minLength)
{
    return 'Bitte geben Sie mind. ' + minLength + ' Zeichen ein.';
}

jQuery("#%s").select2(
{
    width:                  '%s',
    minimumInputLength:     %s,
    placeholder:            '%s',
    allowClear:             %s,
    formatSelection:        %s,
    formatResult:           %s,
    formatNoMatches:        %s,
    formatInputTooShort:    %s,
    ajax: {
        url:        '%s',
        //dataType:   'json',
        type: 'POST',
        quietMillis: 100,
        data:       function (param, page)
        {
            return {
                q:     param.term,
                //limit: 10,
                //page:  page
            };
        },
        processResults: function (data, params) {
            %s
            var newdata = $.map(data, function (obj, key) {
                var newobj = {
                    text : obj.text || obj, // replace value with the property used for the text
                    id : obj.id || key // replace key with the property used for the text
                };
                return newobj;
            });
            return {
                results: newdata,
            };
        },
    }
});

jQuery(document).ready(function() {
    %s
});

</script>
EOF
            ,
            $id,
            $this->getOption('width'),
            $this->getOption('minimumInputLength'),
            $this->getOption('placeholder', ''),
            $this->getOption('allowClear') == true ? 'true' : 'false',
            $this->getOption('formatSelection'),
            $this->getOption('formatResult'),
            $this->getOption('formatNoMatches'),
            $this->getOption('formatInputTooShort'),
            $this->getOption('url'),
            $result_callback = $this->getOption('result_callback') ? $this->getOption('result_callback') . '();' : '',
            $setDefaultValue

        );

        return $return;
    }


}
