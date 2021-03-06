<?php

class ViewBrowserPluginTest extends PHPUnit_Framework_TestCase
{
    private $pi;

    protected function setUp()
    {
        $this->pi = new ViewBrowserPlugin;
        $this->pi->activate();
    }

    public function parseHtmlDataProvider()
    {
        return [
            'lower case placeholder' => [
                12, 'here is the first content [viewbrowser]', 'fsdf@sfsd.com',  array('uniqid' => '0987654321'),
                'here is the first content <a href="http://mysite.com/lists/?m=12&amp;uid=0987654321&amp;p=view&amp;pi=ViewBrowserPlugin" >View in your browser</a>'
            ],
            'upper case placeholder' => [
                13, 'here is the second content [VIEWBROWSER]', 'fsdf@sfsd.com',  array('uniqid' => '1234567890'),
                'here is the second content <a href="http://mysite.com/lists/?m=13&amp;uid=1234567890&amp;p=view&amp;pi=ViewBrowserPlugin" >View in your browser</a>'
            ],
            'url placeholder' => [
                13, 'here is the third content [VIEWBROWSERURL]', 'fsdf@sfsd.com',  array('uniqid' => '1234567890'),
                'here is the third content http://mysite.com/lists/?m=13&amp;uid=1234567890&amp;p=view&amp;pi=ViewBrowserPlugin'
            ],
            'archive placeholder' => [
                13, 'here is the fourth content [ARCHIVE]', 'fsdf@sfsd.com',  array('uniqid' => '1234567890'),
                'here is the fourth content <a href="http://mysite.com/lists/?p=archive&amp;pi=ViewBrowserPlugin&amp;uid=1234567890" >archive</a>'
            ],
            'archive url placeholder' => [
                13, 'here is the fifth content [ARCHIVEURL]', 'fsdf@sfsd.com',  array('uniqid' => '1234567890'),
                'here is the fifth content http://mysite.com/lists/?p=archive&amp;pi=ViewBrowserPlugin&amp;uid=1234567890'
            ],
            'placeholder with message id' => [
                13, 'here is the sixth content [VIEWBROWSER:123]', 'fsdf@sfsd.com',  array('uniqid' => '1234567890'),
                'here is the sixth content <a href="http://mysite.com/lists/?m=123&amp;uid=1234567890&amp;p=view&amp;pi=ViewBrowserPlugin" >View in your browser</a>'
            ],
            'url placeholder with message id' => [
                13, 'here is the seventh content [VIEWBROWSERURL:345]', 'fsdf@sfsd.com',  array('uniqid' => '1234567890'),
                'here is the seventh content http://mysite.com/lists/?m=345&amp;uid=1234567890&amp;p=view&amp;pi=ViewBrowserPlugin'
            ],
        ];
    }
    /**
     * @test
     * @dataProvider parseHtmlDataProvider
     */
    public function parseOutgoingHTMLMessage($mid, $content, $email, $user, $expected)
    {
        $this->assertEquals(
            $expected,
            $this->pi->parseOutgoingHTMLMessage($mid, $content, $email, $user)
        );
    }

    public function parseTextDataProvider()
    {
        return [
            'lower case placeholder' => [
                12, 'here is the first content [viewbrowser]', 'fsdf@sfsd.com',  array('uniqid' => '0987654321'),
                "here is the first content View in your browser http://mysite.com/lists/?m=12&uid=0987654321&p=view&pi=ViewBrowserPlugin"
            ],
            'upper case placeholder' => [
                13, 'here is the second content [VIEWBROWSER]', 'fsdf@sfsd.com',  array('uniqid' => '1234567890'),
                "here is the second content View in your browser http://mysite.com/lists/?m=13&uid=1234567890&p=view&pi=ViewBrowserPlugin"
            ],
            'url placeholder' => [
                13, 'here is the third content [VIEWBROWSERURL]', 'fsdf@sfsd.com',  array('uniqid' => '1234567890'),
                'here is the third content http://mysite.com/lists/?m=13&uid=1234567890&p=view&pi=ViewBrowserPlugin'
            ],
            'archive placeholder' => [
                13, 'here is the fourth content [ARCHIVE]', 'fsdf@sfsd.com',  array('uniqid' => '1234567890'),
                'here is the fourth content archive http://mysite.com/lists/?p=archive&pi=ViewBrowserPlugin&uid=1234567890'
            ],
            'archive url placeholder' => [
                13, 'here is the fifth content [ARCHIVEURL]', 'fsdf@sfsd.com',  array('uniqid' => '1234567890'),
                'here is the fifth content http://mysite.com/lists/?p=archive&pi=ViewBrowserPlugin&uid=1234567890'
            ],
            'placeholder with message id' => [
                13, 'here is the sixth content [VIEWBROWSER:987]', 'fsdf@sfsd.com',  array('uniqid' => '1234567890'),
                "here is the sixth content View in your browser http://mysite.com/lists/?m=987&uid=1234567890&p=view&pi=ViewBrowserPlugin"
            ],
            'url placeholder with message id' => [
                13, 'here is the seventh content [VIEWBROWSERURL:765]', 'fsdf@sfsd.com',  array('uniqid' => '1234567890'),
                'here is the seventh content http://mysite.com/lists/?m=765&uid=1234567890&p=view&pi=ViewBrowserPlugin'
            ],
        ];
    }
    /**
     * @test
     * @dataProvider parseTextDataProvider
     */
    public function parseOutgoingTextMessage($mid, $content, $email, $user, $expected)
    {
        $this->assertEquals(
            $expected,
            $this->pi->parseOutgoingTextMessage($mid, $content, $email, $user)
        );
    }
}
