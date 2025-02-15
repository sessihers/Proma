<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class IssueNote extends Model implements Searchable
{
    protected $table = 'issues_notes';

    protected $fillable = [
        'issue_id', 'description'
    ];

    public function issue()
    {
        return $this->belongsTo('App\Issue');
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->description,
            '/issue/' . $this->issue_id
        );
    }
}
