<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    private function mahasiswa(): array
    {
        return [
            'name' => 'Alfianz Risqia Ilahi Loven Kary',
            'nrp' => '5025241164',
            'program' => 'Teknik Informatika',
            'faculty' => 'FTEIC — ITS',
            'semester' => 'Semester 5',
            'ip1' => 3.70,
            'ip2' => 3.80,
            'bio' => 'Mahasiswa Informatika yang tertarik pada pengembangan web, teknologi AI, dan pembangunan produk digital yang bermanfaat.',
            'interests' => ['Web Development', 'Agentic AI', 'Cyber Security', 'UI/UX'],
        ];
    }

    public function home(Request $request)
    {
        $mahasiswa = $this->mahasiswa();
        $ip1 = $mahasiswa['ip1'];
        $ip2 = $mahasiswa['ip2'];
        $ipk = ($ip1 + $ip2) / 2;
        $user = $request->query('user');

        return view('home', compact('mahasiswa', 'ip1', 'ip2', 'ipk', 'user'));
    }

    public function profile()
    {
        $profile = $this->mahasiswa();
        $profile['ipk'] = ($profile['ip1'] + $profile['ip2']) / 2;

        return view('mahasiswa.show', compact('profile'));
    }

    public function agent(Request $request)
    {
        $tema = $request->query('tema', 'Agentic Network Security Harness');
        $mode = $request->query('mode', 'light');

        $topics = [
            'Agentic Network Security Harness' => 'An extensible security investigation platform where an LLM agent dynamically plans and executes network and log analysis using native tools and MCP integrations.',
            'Network Recon' => 'A security investigation skill focused on understanding network targets and available services as the first step of a controlled investigation.',
            'Log Analysis' => 'A skill for analyzing security logs, correlating events, and identifying evidence that may indicate suspicious activity.',
            'Attack Entry Point Analysis' => 'A skill that connects evidence across network activity, logs, and artifacts to investigate how suspicious activity may have entered a system.',
        ];

        $description = $topics[$tema] ?? 'A security investigation capability within the Agentic Network Security Harness, designed around controlled planning, tool execution, evidence collection, and adaptive investigation.';
        $isDark = $mode === 'dark';

        return view('agent.show', compact('tema', 'description', 'isDark'));
    }

    public function submitIdea(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'idea' => ['required', 'string', 'max:1000'],
        ]);

        return redirect()
            ->route('agent.show')
            ->with('success', 'Ide berhasil dikirim. Terima kasih!');
    }

    public function ipkForm()
    {
        return view('ipk.calculate');
    }

    public function ipkCalculate(float $ip1, float $ip2)
    {
        if ($ip1 < 0 || $ip1 > 4 || $ip2 < 0 || $ip2 > 4) {
            abort(404);
        }

        $ipk = ($ip1 + $ip2) / 2;

        return view('ipk.calculate', compact('ip1', 'ip2', 'ipk'));
    }
}
