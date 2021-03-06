<?php

namespace Grundmanis\Laracms\Modules\Pages\Controllers;

use App\Http\Controllers\Controller;
use Grundmanis\Laracms\Modules\Pages\LayoutsLoader;
use Grundmanis\Laracms\Modules\Pages\Models\LaracmsPage;
use Grundmanis\Laracms\Modules\Pages\Requests\PageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{
    /**
     * @var LaracmsPage
     */
    private $page;

    /**
     * @var LayoutsLoader
     */
    private $layoutsLoader;

    /**
     * PagesController constructor.
     * @param LaracmsPage $page
     * @param LayoutsLoader $layoutsLoader
     */
    public function __construct(LaracmsPage $page, LayoutsLoader $layoutsLoader)
    {
        $this->page = $page;
        $this->layoutsLoader = $layoutsLoader;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $view = view()->exists('laracms.pages.index') ? 'laracms.pages.index' : 'laracms.pages::index';

        return view($view, [
            'pages' => $this->page->paginate(10)
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $layouts = $this->layoutsLoader->load();
        $view = view()->exists('laracms.pages.form') ? 'laracms.pages.form' : 'laracms.pages::form';

        return view($view, compact('layouts'));
    }

    /**
     * @param PageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PageRequest $request)
    {
        $this->page->create($request->all());

        return redirect()->route('laracms.pages')->with('status', __('laracms::admin.page_created'));
    }

    /**
     * @param LaracmsPage $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(LaracmsPage $page)
    {
        $layouts = $this->layoutsLoader->load();
        $view = view()->exists('laracms.pages.form') ? 'laracms.pages.form' : 'laracms.pages::form';

        return view($view, compact('page', 'layouts'));
    }

    /**
     * @param LaracmsPage $page
     * @param PageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LaracmsPage $page, PageRequest $request)
    {
        $page->update($request->all());

        return back()->with('status', __('laracms::admin.page_updated'));
    }

    /**
     * @param LaracmsPage $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(LaracmsPage $page)
    {
        $page->delete();

        return redirect()->route('laracms.pages')->with('status', __('laracms::admin.page_deleted'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function images(Request $request)
    {
        $request->file->storeAs('public/uploads', $request->key);
        return response(null, 204);
    }
}