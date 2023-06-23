<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\File;
use Sixlive\TextCopy\TextCopy;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Lecture extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Lecture>
     */
    public static $model = \App\Models\Lecture::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'theme';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            BelongsTo::make('Meeting')
                ->onlyOnForms()
                ->rules('required'),

            BelongsTo::make('Announcer')
                ->onlyOnForms()
                ->rules('required'),

            Text::make('Theme')
                ->sortable()
                ->rules('required','min:2','max:255'),

            BelongsTo::make('Start','slot',"App\Nova\Slot")
                ->display(function($slot){ return $slot->start; })
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            BelongsTo::make('End','slot',"App\Nova\Slot")
                ->display(function($slot){ return $slot->end; })
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            BelongsTo::make('Time','slot',"App\Nova\Slot")->onlyOnForms(),

            Textarea::make('Description')
                ->rules('required'),

            File::make('Presentation')
                ->rules('max:10240','nullable','mimes:ppt,pptx')
                ->nullable(),

            Boolean::make('Online','zoom_id')->onlyOnIndex(),

            Text::make('Zoom Url','zoom')
                ->displayUsing(function ($zoom){ return $zoom->join_url; })
                ->onlyOnDetail()
                ->copyable(),

            Boolean::make('Online','zoom')->onlyOnForms()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->with('zoom');
    }
}
