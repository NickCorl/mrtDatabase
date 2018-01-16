
<p>There are circumstances where enhanced tags will not be capable enough to handle
your needs, and for those, NBBC supports <i>callback tags</i> --- tags that call a
function you provide to perform their validation and formatting.</p>

<p>So let's look at how to add a simple callback tag:  Even though we can do <tt>[border]</tt>
as an enhanced tag, let's look now at how to implement it as a callback tag instead.</p>

<p>First, you'll need to alter the rule definition.  Start with the same basic definition
we've used before, but use <tt>BBCODE_MODE_CALLBACK</tt> and add a 'method' parameter:</p>

<div class='code_header'>Code:</div>
<xmp class='code'>    $bbcode->AddRule('border',  Array(
        'mode' => BBCODE_MODE_CALLBACK,
        'method' => 'MyBorderFunction',
        'class' => 'block',
        'allow_in' => Array('listitem', 'block', 'columns'),
    ));</xmp>

<p>Somewhere else in your code, you'll need to provide the callback function itself,
which, in this case, is named "<tt>MyBorderFunction</tt>":</p>

<div class='code_header'>Code:</div>
<xmp class='code'>function MyBorderFunction($bbcode, $action, $name,
    $default, $params, $content) {
    ....
}</xmp>

	<div class='tipbox'>
	<div class='tipbox_header'>
		<div class='tipbox_star'>*</div><div><b>Tech Tip</b></div>
	</div>
	<div class='tipbox_content'><div class='tipbox_content2'>
		<p>NBBC uses PHP's <tt>call_user_func()</tt> function to call your function, so it
		doesn't need to be just a function name:  If you want NBBC to call a method of an
		object of a particular class, you can supply an array instead of a string, like
		this (where <tt>$obj</tt> contains an object with a member function named "<tt>MyMethod</tt>"):</p>
		
		<p><tt>'method' =&gt; Array($obj, 'MyMethod'),</tt></p>
	</div></div>
	</div>

<p>Let's look at how the callback function works.  First, these are its parameters:</p>

<ul>
<li><b><tt>$bbcode</tt></b> - The <tt>BBCode</tt> object that is currently doing the parsing.</li>
<li><b><tt>$action</tt></b> - Always one of <tt>BBCODE_CHECK</tt> or <tt>BBCODE_OUTPUT</tt>,
	provided to indicate why this function was called and what it should return.</li>
<li><b><tt>$name</tt></b> - The tag name:  In the <tt>[border]</tt> example, this would contain the string "<tt>border</tt>".</li>
<li><b><tt>$default</tt></b> - The default value of the tag.  If the user were to type <tt>[border=1 color=red]</tt>,
	the default value would be "<tt>1</tt>".</li>
<li><b><tt>$params</tt></b> - The parameters of the tag, some given by the user,
	some generated by NBBC, stored in an array of key =&gt; value pairs.
	In the example of <tt>[border=1 color=red]Hello[/border]</tt>, this array might contain:
	<ul>
	<li>'<tt>_name</tt>' =&gt; '<tt>border</tt>'</li>
	<li>'<tt>_default</tt>' =&gt; '<tt>1</tt>'</li>
	<li>'<tt>color</tt>' =&gt; '<tt>red</tt>'</li>
	</ul>
	A full list of the values NBBC adds to the tag parameters is included
	<a href="../../../../nbbc-1.4.5/doc/src/app_tagparams.html">in the Appendix</a>.
	</li>
<li><b><tt>$content</tt></b> - Only valid when <tt>$action</tt> is <tt>BBCODE_OUTPUT</tt>,
	this is the content (body) of the tag, already converted to valid HTML.  In the example of
	<tt>[border=1 color=red]Hello[/border]</tt>, <tt>$content</tt> would contain the string "<tt>Hello</tt>".</li>
</ul>

<p>The callback function is called in two stages.  First, after the start tag has been read by the
parser, the callback function is called immediately with <tt>$action</tt> set to <tt>BBCODE_CHECK</tt>.
This gives the tag the opportunity to decide whether the parameters the user provides make any sense;
and this is when we would reject bad sizes and colors in our <tt>[border]</tt> example:</p>

<div class='code_header'>Code:</div>
<xmp class='code'>function MyBorderFunction($bbcode, $action, $name,
    $default, $params, $content) {
    if ($action == BBCODE_CHECK) {
        if (isset($params['color'])
            && !preg_match('/^#[0-9a-fA-F]+|[a-zA-Z]+$/', $params['color']))
            return false;
        if (isset($params['size'])
            && !preg_match('/^[1-9][0-9]*$/', $params['size']))
            return false;
        return true;
    }
}</xmp>

<p>A call with <tt>$action == BBCODE_CHECK</tt> must return either <tt>true</tt> or <tt>false</tt>:
If it returns <tt>true</tt>, NBBC will assume the tag is acceptable; if it returns <tt>false</tt>,
NBBC will assume that the tag is unacceptable and will not treat it as a tag or evaluate it further.</p>

<p>The second time the function is called is with <tt>$action</tt> set to <tt>BBCODE_OUTPUT</tt>.
If <tt>$action</tt> is <tt>BBCODE_OUTPUT</tt>, NBBC is asking the
function to generate HTML from its inputs.  The return value must
be a string, and must contain HTML or plain text:  No BBCode tags.  A typical implementation for
our <tt>[border]</tt> example might look like this:</p>

<div class='code_header'>Code:</div>
<xmp class='code'>function MyBorderFunction($bbcode, $action, $name,
    $default, $params, $content) {
    if ($action == BBCODE_CHECK) {
        if (isset($params['color'])
            && !preg_match('/^#[0-9a-fA-F]+|[a-zA-Z]+$/', $params['color']))
            return false;
        if (isset($params['size'])
            && !preg_match('/^[1-9][0-9]*$/', $params['size']))
            return false;
        return true;
    }

    $color = isset($params['color']) ? $params['color'] : "blue";
    $size = isset($params['size']) ? $params['size'] : 1;
    return "<div style=\"border: {$size}px solid $color\">$content</div>";
}</xmp>

	<div class='tipbox'>
	<div class='tipbox_header'>
		<div class='tipbox_star'>*</div><div><b>Tech Tip</b></div>
	</div>
	<div class='tipbox_content'><div class='tipbox_content2'>
		<p>When you implement a callback function, take special care to note which parameters are
		validated and which parameters are not:</p>
		
		<ul>
		<li><b><tt>$default</tt></b> contains exactly what the user typed, and has not been passed through
			<tt>htmlspecialchars()</tt> or <tt>htmlentities()</tt> or any other cleanup function.
			If you output this value, you should clean it up before outputting it.</li>
		<li><b><tt>$params</tt></b> all contain exactly what the user typed, and none of them have been passed through
			<tt>htmlspecialchars()</tt> or <tt>htmlentities()</tt> or any other cleanup function.
			If you output this value, you should clean it up before outputting it.</li>
		<li><b><tt>$content</tt></b> is always pure, clean output HTML, or pure, clean output plaintext, depending on
			whether it's outputting in HTML or plaintext mode.</li>
		<li><b>Your callback function's return value</b> must always be pure, clean output HTML, or pure, clean output
			plaintext, depending on whether it's outputting in HTML or plaintext mode.</li>
		<li>None of the input parameters to this function will contain any BBCode tags.</li>
		</ul>
	</div></div>
	</div>