<?php 

    namespace App\Console\Commands;

    use GuzzleHttp\Client;
    use GuzzleHttp\Pool;
    use GuzzleHttp\Psr7\Request;
    use GuzzleHttp\Exception\ClientException;
    use Illuminate\Console\Command;
    use Symfony\Component\DomCrawler\Crawler;
    use Symfony\Component\CssSelector;

    class MultithreadingRequest extends Command
    {
    	private $totalPageCount;
    	private $counter = 1;
    	private $concurrency = 7;
    	// 	同时并发抓取 
        private $users = ['CycloneAxe', 'appleboy', 'Aufree', 'lifesign', 'overtrue', 'zhengjinghua', 'NauxLiu'];
    	protected $signature = 'test:multithreading-request';
    	protected $description = 'Command description';
    	public function __construct()
    	{
    		parent::__construct();
    	}
    	public function handle()
    	{
            $this->info('begin');
    		$client = new Client(['base_uri'=>'http://so.iqiyi.com/so/']);
    		$response = $client->get('q_楚乔传?source=input&sr=464884329245');
            $html = $response->getBody();
            $crawler = new Crawler();
            $crawler->addHtmlContent($html);
            // Implicitly cast the body to a string and echo it
            $a = $crawler->filter('.result_title a')->each(function(Crawler $node, $i){
                $this->info($node->attr('title'));
            });
    	}
    	public function countedAndCheckEnded()
    	{
    		if ($this->counter < $this->totalPageCount){
    			$this->counter++;
    			return;
    		}
    		$this->info("请求结束！");
    	}
    }

