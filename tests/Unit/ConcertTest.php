<?php

namespace Tests\Unit;

use App\Concert;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConcertTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_the_formatted_date()
    {
        $concert = factory(Concert::class)->make([
            'date' => Carbon::parse('2020-12-01 8:00pm'),
        ]);

        $this->assertEquals('December 1, 2020', $concert->formatted_date);
    }

    /** @test */
    public function it_can_get_the_formatted_start_time()
    {
        $concert = factory(Concert::class)->make([
            'date' => Carbon::parse('2020-12-01 17:00:00'),
        ]);

        $this->assertEquals('5:00pm', $concert->formatted_start_time);
    }

    /** @test */
    public function it_can_get_ticket_price_in_pounds()
    {
        $concert = factory(Concert::class)->make([
            'ticket_price' => 3250,
        ]);

        $this->assertEquals('32.50', $concert->ticket_price_in_pounds);
    }

    /** @test */
    public function concerts_with_a_published_at_date_are_published()
    {
        $publishedConcertA = factory(Concert::class)->create([
            'published_at' => Carbon::parse('-1 week'),
        ]);
        $publishedConcertB = factory(Concert::class)->create([
            'published_at' => Carbon::parse('-2 weeks'),
        ]);
        $unpublishedConcert = factory(Concert::class)->create([
            'published_at' => null,
        ]);

        $publishedConcerts = Concert::published()->get();

        $this->assertTrue($publishedConcerts->contains($publishedConcertA));
        $this->assertTrue($publishedConcerts->contains($publishedConcertB));
        $this->assertFalse($publishedConcerts->contains($unpublishedConcert));
    }

    /** @test */
    public function it_can_order_concert_tickets()
    {
        $concert = factory(Concert::class)->create();

        $order = $concert->orderTickets('john@example.com', 3);

        $this->assertEquals('john@example.com', $order->email);
        $this->assertEquals(3, $order->tickets()->count());
    }
}
