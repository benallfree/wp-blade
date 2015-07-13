<?php
namespace BenAllfree\WordPress\Blade;

/* Mini Blade */
class Blade
{
  static protected $config = null;
  static function configure($args)
  {
    self::$config = $args;
  }
  
  function __construct($fname)
  {
    $this->fname = $fname;
  }
  
  static function make($view_name, $args)
  {
    $fname = self::$config['root'];
    $parts = join('/',explode('.', $view_name));
    $parts.= ".blade.php";
    $fname .= $parts;
    if(!file_exists($fname)) throw new Exception("Blade file {$fname} not found.");
    return new Bladepress($fname);
  }
  
  function with($args)
  {
    $this->args = $args;
    return $this;
  }
  
  function render()
  {
    $s = file_get_contents($this->fname);
    $s = preg_replace('/@foreach(.*?)\n/', "<?php foreach\$1: ?>\n" , $s);
    $s = preg_replace('/@endforeach\n/', "<?php endforeach; ?>\n" , $s);
    $s = preg_replace('/@if(.*?)\n/', "<?php if\$1: ?>\n" , $s);
    $s = preg_replace('/@else\n/', "<?php else: ?>\n" , $s);
    $s = preg_replace('/@endif\n/', "<?php endif; ?>\n" , $s);
    $s = preg_replace("/{{{(.*?)}}}/", '<?php echo(htmlentities($1)) ?>', $s);
    $s = preg_replace("/{{(.*?)}}/", '<?php echo($1) ?>', $s);
    $tmpfname = tempnam(sys_get_temp_dir(), "recast_");
    file_put_contents($tmpfname, $s);
    $content = self::sandbox($tmpfname, $args);
    unlink($tmpfname);
    return do_shortcode($content);
  }
  
  static function sandbox($__fname, $__vars)
  {
    extract($__vars);
    ob_start();
    require($__fname);
    return ob_get_clean();
  }
}