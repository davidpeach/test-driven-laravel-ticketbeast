<?php

namespace Tests\Feature;

use App\Concert;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewConcertListingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_view_a_concert_listing()
    {
        $this->withoutExceptionHandling();

        // ...Given we have a concert...
        $concert = Concert::create([
            'title' => 'The Main Act',
            'subtitle' => 'Supporting Roles',
            'date' => Carbon::parse('December 13th 2020 8:00pm'),
            'ticket_price' => 3250,
            'venue' => 'The Mosh Pit',
            'venue_address' => '123 Fake Street',
            'city' => 'Laraville',
            'state' => 'Staffs',
            'zip' => 'B783RB',
            'additional_information' => 'For tickets, call (555) 555 555'
        ]);

        // ...When we try to view the conert listing...
        $res = $this->get('/concerts/' . $concert->id);

        // ...Then we should see the concert details...
        // $res->assertStatus(200);
        $res->assertSee('The Main Act');
        $res->assertSee('Supporting Roles');
        $res->assertSee('December 13, 2020');
        $res->assertSee('8:00pm');
        $res->assertSee('The Mosh Pit');
        $res->assertSee('123 Fake Street');
        $res->assertSee('Laraville');
        $res->assertSee('Staffs');
        $res->assertSee('B783RB');
        $res->assertSee('For tickets, call (555) 555 555');
    }
}
