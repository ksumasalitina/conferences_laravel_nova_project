<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,RefreshDatabase;

    protected const URL_REGISTER = '/api/register';
    protected const URL_LOGIN = '/api/login';
    protected const URL_LOGOUT = '/api/logout';
    protected const URL_SUBSCRIBE = '/api/plan/subscribe';
    protected const URL_JOIN = '/api/join/';
    protected const URL_DELETE_MEETING = '/api/meetings/';
    protected const URL_CREATE_LECTURE = '/api/lectures';
    protected const URL_UPDATE_LECTURE = '/api/lectures/';
    protected const URL_DELETE_LECTURE = '/api/lectures/';
    protected const URL_UPDATE_PROFILE = '/api/profile/edit/';
    protected const URL_CREATE_CATEGORY = '/api/category';
    protected const URL_UPDATE_CATEGORY = '/api/category/';
    protected const URL_CREATE_COMMENT = '/api/comments';
    protected const URL_DELETE_COMMENT = '/api/comments/';
    protected const URL_EXPORT_MEETINGS = '/api/meetings/export';
    protected const URL_EXPORT_MEMBERS = '/api/meetings/export/members/';
    protected const URL_EXPORT_LECTURES = '/api/lectures/export/';
    protected const URL_EXPORT_COMMENTS = '/api/comments/export/';
    protected const URL_FILTER_MEETINGS = '/api/meetings/filter';
    protected const URL_FILTER_LECTURES = '/api/lectures/filter';
    protected const URL_SEARCH_MEETINGS = '/api/meetings/search';
    protected const URL_SEARCH_LECTURES = '/api/lectures/search';


    private function generateDefaultData()
    {
        Artisan::call('db:seed', ['--class' => 'RoleSeeder']);
        Artisan::call('db:seed', ['--class' => 'PlanSeeder']);
        Artisan::call('db:seed', ['--class' => 'SlotSeeder']);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->generateDefaultData();
    }
}
