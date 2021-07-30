<?php

use App\Enums\VoteType;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [VoteType::UPVOTE, VoteType::DOWNVOTE]);
            $table->foreignIdFor(Proposal::class, 'proposal_id');
            $table->foreignIdFor(User::class, 'user_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
