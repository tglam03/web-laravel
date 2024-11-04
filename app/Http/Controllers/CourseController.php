<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\StoreCourseRequest;
    use App\Http\Requests\UpdateCourseRequest;
    use App\Models\Course;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\View;
    use Yajra\DataTables\CollectionDataTable;
    use Yajra\Datatables\Datatables;
    use function MongoDB\BSON\toJSON;

    class CourseController extends Controller
    {
        private $model;

//        private string $title;
        public function __construct()
        {
            $this->model = (new Course())->query();
            // breadcrumbs
            $routeName = Route::currentRouteName();       // lấy tên đường dẫn
            $arr = explode('.', $routeName);   // tách chuỗi
            $arr = array_map('ucfirst', $arr);   // viết hoa các phần tử chữ cái đầu trong chuoi
            $title = implode(' - ', $arr);     // nối chuỗi

            View::share('title', $title);         // title page
        }

        public function index()
        {
            print_r("tota \n");
            //        dd($request->all());
//        $search = $request->get('q');
//        $data = Course::query()
//            ->where('name', 'like', value: '%' .  $search . '%')
//            ->paginate('5');
//
//        $data->appends(['q' => $search]);

            return view('courses.index');
        }


        public function api()
        {

            return (new CollectionDataTable(Course::all()))->toJson();

        }
         public function apiName(){

         }
        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('courses.create');
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(StoreCourseRequest $request)
        {
            $this->model::query()->create($request->validated());

            return redirect()->route('courses.index');
        }

        /**
         * Display the specified resource.
         */
        public function show(Course $course)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Course $course)
        {
            return view('courses.edit', [
                'course' => $course
            ]);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(UpdateCourseRequest $request, $courseId)
        {

            $object = $this->model->find($courseId);
            $object->update($request->validated());

            return redirect()->route('courses.index');
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Course $courseId)
        {
            $this->model->where('id', $courseId)->delete();

            return redirect()->route('courses.index');
        }
    }
