<?php

namespace Tests\Feature\Api;

use App\Models\News;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewsTest extends TestCase
{
    public function test_get_news()
    {
        $this->be($this->factoryUser(), 'api');

        $response = $this->get('/api/v1/news');

        $response->assertStatus(200);
    }

    public function test_show_news()
    {
        $this->be($this->factoryUser(), 'api');

        if ($news = News::latest()->first()) {
            $response = $this->get('/api/v1/news/' . $news['id']);
            $response->assertStatus(200);
        }
    }
}
