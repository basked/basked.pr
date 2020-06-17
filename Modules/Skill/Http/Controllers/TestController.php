<?php

namespace Modules\Skill\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Date;
use Modules\Skill\Entities\Task;
use Modules\Skill\Entities\tasks;
use Modules\Skill\Entities\Test;


class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $tasks = array(
            [
            'id' => 1,
            'parentId' => 0,
            'title' => 'Software Development',
            'start' => new DateTime('2019-02-21T05:00:00.000Z'),
            'end' => new DateTime('2019-07-04T12:00:00.000Z'),
            'progress' => 31
        ], [
            'id' => 2,
            'parentId' => 1,
            'title' => 'Scope',
            'start' => new DateTime('2019-02-21T05:00:00.000Z'),
            'end' => new DateTime('2019-02-26T09:00:00.000Z'),
            'progress' => 60
        ], [
            'id' => 3,
            'parentId' => 2,
            'title' => 'Determine project scope',
            'start' => new DateTime('2019-02-21T05:00:00.000Z'),
            'end' => new DateTime('2019-02-21T09:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 4,
            'parentId' => 2,
            'title' => 'Secure project sponsorship',
            'start' => new DateTime('2019-02-21T10:00:00.000Z'),
            'end' => new DateTime('2019-02-22T09:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 5,
            'parentId' => 2,
            'title' => 'Define preliminary resources',
            'start' => new DateTime('2019-02-22T10:00:00.000Z'),
            'end' => new DateTime('2019-02-25T09:00:00.000Z'),
            'progress' => 60
        ], [
            'id' => 6,
            'parentId' => 2,
            'title' => 'Secure core resources',
            'start' => new DateTime('2019-02-25T10:00:00.000Z'),
            'end' => new DateTime('2019-02-26T09:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 7,
            'parentId' => 2,
            'title' => 'Scope complete',
            'start' => new DateTime('2019-02-26T09:00:00.000Z'),
            'end' => new DateTime('2019-02-26T09:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 8,
            'parentId' => 1,
            'title' => 'Analysis/Software Requirements',
            'start' => new DateTime('2019-02-26T10:00:00.000Z'),
            'end' => new DateTime('2019-03-18T09:00:00.000Z'),
            'progress' => 80
        ], [
            'id' => 9,
            'parentId' => 8,
            'title' => 'Conduct needs analysis',
            'start' => new DateTime('2019-02-26T10:00:00.000Z'),
            'end' => new DateTime('2019-03-05T09:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 10,
            'parentId' => 8,
            'title' => 'Draft preliminary software specifications',
            'start' => new DateTime('2019-03-05T10:00:00.000Z'),
            'end' => new DateTime('2019-03-08T09:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 11,
            'parentId' => 8,
            'title' => 'Develop preliminary budget',
            'start' => new DateTime('2019-03-08T10:00:00.000Z'),
            'end' => new DateTime('2019-03-12T09:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 12,
            'parentId' => 8,
            'title' => 'Review software specifications/budget with team',
            'start' => new DateTime('2019-03-12T10:00:00.000Z'),
            'end' => new DateTime('2019-03-12T14:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 13,
            'parentId' => 8,
            'title' => 'Incorporate feedback on software specifications',
            'start' => new DateTime('2019-03-13T05:00:00.000Z'),
            'end' => new DateTime('2019-03-13T14:00:00.000Z'),
            'progress' => 70
        ], [
            'id' => 14,
            'parentId' => 8,
            'title' => 'Develop delivery timeline',
            'start' => new DateTime('2019-03-14T05:00:00.000Z'),
            'end' => new DateTime('2019-03-14T14:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 15,
            'parentId' => 8,
            'title' => 'Obtain approvals to proceed (concept, timeline, budget)',
            'start' => new DateTime('2019-03-15T05:00:00.000Z'),
            'end' => new DateTime('2019-03-15T09:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 16,
            'parentId' => 8,
            'title' => 'Secure required resources',
            'start' => new DateTime('2019-03-15T10:00:00.000Z'),
            'end' => new DateTime('2019-03-18T09:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 17,
            'parentId' => 8,
            'title' => 'Analysis complete',
            'start' => new DateTime('2019-03-18T09:00:00.000Z'),
            'end' => new DateTime('2019-03-18T09:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 18,
            'parentId' => 1,
            'title' => 'Design',
            'start' => new DateTime('2019-03-18T10:00:00.000Z'),
            'end' => new DateTime('2019-04-05T14:00:00.000Z'),
            'progress' => 80
        ], [
            'id' => 19,
            'parentId' => 18,
            'title' => 'Review preliminary software specifications',
            'start' => new DateTime('2019-03-18T10:00:00.000Z'),
            'end' => new DateTime('2019-03-20T09:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 20,
            'parentId' => 18,
            'title' => 'Develop functional specifications',
            'start' => new DateTime('2019-03-20T10:00:00.000Z'),
            'end' => new DateTime('2019-03-27T09:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 21,
            'parentId' => 18,
            'title' => 'Develop prototype based on functional specifications',
            'start' => new DateTime('2019-03-27T10:00:00.000Z'),
            'end' => new DateTime('2019-04-02T09:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 22,
            'parentId' => 18,
            'title' => 'Review functional specifications',
            'start' => new DateTime('2019-04-02T10:00:00.000Z'),
            'end' => new DateTime('2019-04-04T09:00:00.000Z'),
            'progress' => 30
        ], [
            'id' => 23,
            'parentId' => 18,
            'title' => 'Incorporate feedback into functional specifications',
            'start' => new DateTime('2019-04-04T10:00:00.000Z'),
            'end' => new DateTime('2019-04-05T09:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 24,
            'parentId' => 18,
            'title' => 'Obtain approval to proceed',
            'start' => new DateTime('2019-04-05T10:00:00.000Z'),
            'end' => new DateTime('2019-04-05T14:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 25,
            'parentId' => 18,
            'title' => 'Design complete',
            'start' => new DateTime('2019-04-05T14:00:00.000Z'),
            'end' => new DateTime('2019-04-05T14:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 26,
            'parentId' => 1,
            'title' => 'Development',
            'start' => new DateTime('2019-04-08T05:00:00.000Z'),
            'end' => new DateTime('2019-05-07T12:00:00.000Z'),
            'progress' => 42
        ], [
            'id' => 27,
            'parentId' => 26,
            'title' => 'Review functional specifications',
            'start' => new DateTime('2019-04-08T05:00:00.000Z'),
            'end' => new DateTime('2019-04-08T14:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 28,
            'parentId' => 26,
            'title' => 'Identify modular/tiered design parameters',
            'start' => new DateTime('2019-04-09T05:00:00.000Z'),
            'end' => new DateTime('2019-04-09T14:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 29,
            'parentId' => 26,
            'title' => 'Assign development staff',
            'start' => new DateTime('2019-04-10T05:00:00.000Z'),
            'end' => new DateTime('2019-04-10T14:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 30,
            'parentId' => 26,
            'title' => 'Develop code',
            'start' => new DateTime('2019-04-11T05:00:00.000Z'),
            'end' => new DateTime('2019-05-01T14:00:00.000Z'),
            'progress' => 49
        ], [
            'id' => 31,
            'parentId' => 26,
            'title' => 'Developer testing (primary debugging)',
            'start' => new DateTime('2019-04-16T12:00:00.000Z'),
            'end' => new DateTime('2019-05-07T12:00:00.000Z'),
            'progress' => 24
        ], [
            'id' => 32,
            'parentId' => 26,
            'title' => 'Development complete',
            'start' => new DateTime('2019-05-07T12:00:00.000Z'),
            'end' => new DateTime('2019-05-07T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 33,
            'parentId' => 1,
            'title' => 'Testing',
            'start' => new DateTime('2019-04-08T05:00:00.000Z'),
            'end' => new DateTime('2019-06-13T12:00:00.000Z'),
            'progress' => 23
        ], [
            'id' => 34,
            'parentId' => 33,
            'title' => 'Develop unit test plans using product specifications',
            'start' => new DateTime('2019-04-08T05:00:00.000Z'),
            'end' => new DateTime('2019-04-11T14:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 35,
            'parentId' => 33,
            'title' => 'Develop integration test plans using product specifications',
            'start' => new DateTime('2019-04-08T05:00:00.000Z'),
            'end' => new DateTime('2019-04-11T14:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 36,
            'parentId' => 33,
            'title' => 'Unit Testing',
            'start' => new DateTime('2019-05-07T12:00:00.000Z'),
            'end' => new DateTime('2019-05-28T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 37,
            'parentId' => 36,
            'title' => 'Review modular code',
            'start' => new DateTime('2019-05-07T12:00:00.000Z'),
            'end' => new DateTime('2019-05-14T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 38,
            'parentId' => 36,
            'title' => 'Test component modules to product specifications',
            'start' => new DateTime('2019-05-14T12:00:00.000Z'),
            'end' => new DateTime('2019-05-16T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 39,
            'parentId' => 36,
            'title' => 'Identify anomalies to product specifications',
            'start' => new DateTime('2019-05-16T12:00:00.000Z'),
            'end' => new DateTime('2019-05-21T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 40,
            'parentId' => 36,
            'title' => 'Modify code',
            'start' => new DateTime('2019-05-21T12:00:00.000Z'),
            'end' => new DateTime('2019-05-24T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 41,
            'parentId' => 36,
            'title' => 'Re-test modified code',
            'start' => new DateTime('2019-05-24T12:00:00.000Z'),
            'end' => new DateTime('2019-05-28T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 42,
            'parentId' => 36,
            'title' => 'Unit testing complete',
            'start' => new DateTime('2019-05-28T12:00:00.000Z'),
            'end' => new DateTime('2019-05-28T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 43,
            'parentId' => 33,
            'title' => 'Integration Testing',
            'start' => new DateTime('2019-05-28T12:00:00.000Z'),
            'end' => new DateTime('2019-06-13T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 44,
            'parentId' => 43,
            'title' => 'Test module integration',
            'start' => new DateTime('2019-05-28T12:00:00.000Z'),
            'end' => new DateTime('2019-06-04T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 45,
            'parentId' => 43,
            'title' => 'Identify anomalies to specifications',
            'start' => new DateTime('2019-06-04T12:00:00.000Z'),
            'end' => new DateTime('2019-06-06T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 46,
            'parentId' => 43,
            'title' => 'Modify code',
            'start' => new DateTime('2019-06-06T12:00:00.000Z'),
            'end' => new DateTime('2019-06-11T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 47,
            'parentId' => 43,
            'title' => 'Re-test modified code',
            'start' => new DateTime('2019-06-11T12:00:00.000Z'),
            'end' => new DateTime('2019-06-13T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 48,
            'parentId' => 43,
            'title' => 'Integration testing complete',
            'start' => new DateTime('2019-06-13T12:00:00.000Z'),
            'end' => new DateTime('2019-06-13T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 49,
            'parentId' => 1,
            'title' => 'Training',
            'start' => new DateTime('2019-04-08T05:00:00.000Z'),
            'end' => new DateTime('2019-06-10T12:00:00.000Z'),
            'progress' => 25
        ], [
            'id' => 50,
            'parentId' => 49,
            'title' => 'Develop training specifications for end users',
            'start' => new DateTime('2019-04-08T05:00:00.000Z'),
            'end' => new DateTime('2019-04-10T14:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 51,
            'parentId' => 49,
            'title' => 'Develop training specifications for helpdesk support staff',
            'start' => new DateTime('2019-04-08T05:00:00.000Z'),
            'end' => new DateTime('2019-04-10T14:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 52,
            'parentId' => 49,
            'title' => 'Identify training delivery methodology (computer based training, classroom, etc.)',
            'start' => new DateTime('2019-04-08T05:00:00.000Z'),
            'end' => new DateTime('2019-04-09T14:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 53,
            'parentId' => 49,
            'title' => 'Develop training materials',
            'start' => new DateTime('2019-05-07T12:00:00.000Z'),
            'end' => new DateTime('2019-05-28T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 54,
            'parentId' => 49,
            'title' => 'Conduct training usability study',
            'start' => new DateTime('2019-05-28T12:00:00.000Z'),
            'end' => new DateTime('2019-06-03T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 55,
            'parentId' => 49,
            'title' => 'Finalize training materials',
            'start' => new DateTime('2019-06-03T12:00:00.000Z'),
            'end' => new DateTime('2019-06-06T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 56,
            'parentId' => 49,
            'title' => 'Develop training delivery mechanism',
            'start' => new DateTime('2019-06-06T12:00:00.000Z'),
            'end' => new DateTime('2019-06-10T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 57,
            'parentId' => 49,
            'title' => 'Training materials complete',
            'start' => new DateTime('2019-06-10T12:00:00.000Z'),
            'end' => new DateTime('2019-06-10T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 58,
            'parentId' => 1,
            'title' => 'Documentation',
            'start' => new DateTime('2019-04-08T05:00:00.000Z'),
            'end' => new DateTime('2019-05-20T09:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 59,
            'parentId' => 58,
            'title' => 'Develop Help specification',
            'start' => new DateTime('2019-04-08T05:00:00.000Z'),
            'end' => new DateTime('2019-04-08T14:00:00.000Z'),
            'progress' => 80
        ], [
            'id' => 60,
            'parentId' => 58,
            'title' => 'Develop Help system',
            'start' => new DateTime('2019-04-22T10:00:00.000Z'),
            'end' => new DateTime('2019-05-13T09:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 61,
            'parentId' => 58,
            'title' => 'Review Help documentation',
            'start' => new DateTime('2019-05-13T10:00:00.000Z'),
            'end' => new DateTime('2019-05-16T09:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 62,
            'parentId' => 58,
            'title' => 'Incorporate Help documentation feedback',
            'start' => new DateTime('2019-05-16T10:00:00.000Z'),
            'end' => new DateTime('2019-05-20T09:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 63,
            'parentId' => 58,
            'title' => 'Develop user manuals specifications',
            'start' => new DateTime('2019-04-08T05:00:00.000Z'),
            'end' => new DateTime('2019-04-09T14:00:00.000Z'),
            'progress' => 65
        ], [
            'id' => 64,
            'parentId' => 58,
            'title' => 'Develop user manuals',
            'start' => new DateTime('2019-04-22T10:00:00.000Z'),
            'end' => new DateTime('2019-05-13T09:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 65,
            'parentId' => 58,
            'title' => 'Review all user documentation',
            'start' => new DateTime('2019-05-13T10:00:00.000Z'),
            'end' => new DateTime('2019-05-15T09:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 66,
            'parentId' => 58,
            'title' => 'Incorporate user documentation feedback',
            'start' => new DateTime('2019-05-15T10:00:00.000Z'),
            'end' => new DateTime('2019-05-17T09:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 67,
            'parentId' => 58,
            'title' => 'Documentation complete',
            'start' => new DateTime('2019-05-20T09:00:00.000Z'),
            'end' => new DateTime('2019-05-20T09:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 68,
            'parentId' => 1,
            'title' => 'Pilot',
            'start' => new DateTime('2019-03-18T10:00:00.000Z'),
            'end' => new DateTime('2019-06-24T12:00:00.000Z'),
            'progress' => 22
        ], [
            'id' => 69,
            'parentId' => 68,
            'title' => 'Identify test group',
            'start' => new DateTime('2019-03-18T10:00:00.000Z'),
            'end' => new DateTime('2019-03-19T09:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 70,
            'parentId' => 68,
            'title' => 'Develop software delivery mechanism',
            'start' => new DateTime('2019-03-19T10:00:00.000Z'),
            'end' => new DateTime('2019-03-20T09:00:00.000Z'),
            'progress' => 100
        ], [
            'id' => 71,
            'parentId' => 68,
            'title' => 'Install/deploy software',
            'start' => new DateTime('2019-06-13T12:00:00.000Z'),
            'end' => new DateTime('2019-06-14T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 72,
            'parentId' => 68,
            'title' => 'Obtain user feedback',
            'start' => new DateTime('2019-06-14T12:00:00.000Z'),
            'end' => new DateTime('2019-06-21T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 73,
            'parentId' => 68,
            'title' => 'Evaluate testing information',
            'start' => new DateTime('2019-06-21T12:00:00.000Z'),
            'end' => new DateTime('2019-06-24T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 74,
            'parentId' => 68,
            'title' => 'Pilot complete',
            'start' => new DateTime('2019-06-24T12:00:00.000Z'),
            'end' => new DateTime('2019-06-24T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 75,
            'parentId' => 1,
            'title' => 'Deployment',
            'start' => new DateTime('2019-06-24T12:00:00.000Z'),
            'end' => new DateTime('2019-07-01T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 76,
            'parentId' => 75,
            'title' => 'Determine final deployment strategy',
            'start' => new DateTime('2019-06-24T12:00:00.000Z'),
            'end' => new DateTime('2019-06-25T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 77,
            'parentId' => 75,
            'title' => 'Develop deployment methodology',
            'start' => new DateTime('2019-06-25T12:00:00.000Z'),
            'end' => new DateTime('2019-06-26T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 78,
            'parentId' => 75,
            'title' => 'Secure deployment resources',
            'start' => new DateTime('2019-06-26T12:00:00.000Z'),
            'end' => new DateTime('2019-06-27T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 79,
            'parentId' => 75,
            'title' => 'Train support staff',
            'start' => new DateTime('2019-06-27T12:00:00.000Z'),
            'end' => new DateTime('2019-06-28T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 80,
            'parentId' => 75,
            'title' => 'Deploy software',
            'start' => new DateTime('2019-06-28T12:00:00.000Z'),
            'end' => new DateTime('2019-07-01T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 81,
            'parentId' => 75,
            'title' => 'Deployment complete',
            'start' => new DateTime('2019-07-01T12:00:00.000Z'),
            'end' => new DateTime('2019-07-01T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 82,
            'parentId' => 1,
            'title' => 'Post Implementation Review',
            'start' => new DateTime('2019-07-01T12:00:00.000Z'),
            'end' => new DateTime('2019-07-04T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 83,
            'parentId' => 82,
            'title' => 'Document lessons learned',
            'start' => new DateTime('2019-07-01T12:00:00.000Z'),
            'end' => new DateTime('2019-07-02T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 84,
            'parentId' => 82,
            'title' => 'Distribute to team members',
            'start' => new DateTime('2019-07-02T12:00:00.000Z'),
            'end' => new DateTime('2019-07-03T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 85,
            'parentId' => 82,
            'title' => 'Create software maintenance team',
            'start' => new DateTime('2019-07-03T12:00:00.000Z'),
            'end' => new DateTime('2019-07-04T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 86,
            'parentId' => 82,
            'title' => 'Post implementation review complete',
            'start' => new DateTime('2019-07-04T12:00:00.000Z'),
            'end' => new DateTime('2019-07-04T12:00:00.000Z'),
            'progress' => 0
        ], [
            'id' => 87,
            'parentId' => 1,
            'title' => 'Software development template complete',
            'start' => new DateTime('2019-07-04T12:00:00.000Z'),
            'end' => new DateTime('2019-07-04T12:00:00.000Z'),
            'progress' => 0
        ]);

        for ($i=0;$i<sizeof($tasks);$i++) {
            $task = new Task();
            $task->id = $tasks[$i]['id'];
            $task->parentId = $tasks[$i]['parentId'];
            $task->title = $tasks[$i]['title'];
            $task->start = $tasks[$i]['start'];
            $task->end = $tasks[$i]['end'];
            $task->progress = $tasks[$i]['progress'];
            $task->save();
        }


        dd($task->all()->toArray());
    }

    public function listLinks()
    {
        $test_data = Test::all()->toJson();
        return view('skill=>=>tests.listLinks', ['test_data' => $test_data]);
    }

    public function testDevExtreme()
    {
        return view('skill=>=>tests.testDevExtreme');
    }


    /**
     * @return Response
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('skill=>=>show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('skill=>=>edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }



    // TESTING DEV EXTREME
    // -=ArrayLayer-
    public function testArrayData()
    {
        return view('skill=>=>tests.dataLayerArray');
    }

    public function testPHPData()
    {
        return view('skill=>=>tests.dataLayerPHP');
    }

    // TESTING DEV EXTREME


}
