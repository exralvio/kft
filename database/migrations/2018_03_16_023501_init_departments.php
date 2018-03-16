<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\UserDepartment;

class InitDepartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $departments = [
            ['DIT NETWORK & IT SOLUTION (NITS)', 'SEKRETARIAT DIREKTORAT NITS'],
            ['DIT NETWORK & IT SOLUTION (NITS)', 'SUB DIT IT STRATEGY & GOVERNANCE'],
            ['DIT NETWORK & IT SOLUTION (NITS)', 'DIVISI PLANNING & DEPLOYMENT'],
            ['DIT NETWORK & IT SOLUTION (NITS)', 'SUB DIT INFRASTRUCTURE STRATEGY & GOVERN'],
            ['DIT NETWORK & IT SOLUTION (NITS)', 'ENGINE TEAM GROUP'],
            ['DIT NETWORK & IT SOLUTION (NITS)', 'SUB DIT INFRASTRUCTURE MANAGEMENT'],
            ['DIT NETWORK & IT SOLUTION (NITS)', 'PROYEK SATELIT TELKOM'],
            ['DIT NETWORK & IT SOLUTION (NITS)', 'DIVISI INFORMATION TECHNOLOGY'],
            ['DIT NETWORK & IT SOLUTION (NITS)', 'DIVISI SERVICE OPERATION'],
            ['DIT NETWORK & IT SOLUTION (NITS)', 'DIVISI SERVICE SOLUTION'],
            ['DIT NETWORK & IT SOLUTION (NITS)', 'SUB DIT INFRASTRUCTURE &SERV PERFORMANCE'],
            ['DIT CONSUMER SERVICE (CONS)','TELKOM REGIONAL I'],
            ['DIT CONSUMER SERVICE (CONS)','TELKOM REGIONAL II'],
            ['DIT CONSUMER SERVICE (CONS)','TELKOM REGIONAL II'],
            ['DIT CONSUMER SERVICE (CONS)','TELKOM REGIONAL IV'],
            ['DIT CONSUMER SERVICE (CONS)','TELKOM REGIONAL V'],
            ['DIT CONSUMER SERVICE (CONS)','TELKOM REGIONAL VI'],
            ['DIT CONSUMER SERVICE (CONS)','TELKOM REGIONAL VII'],
            ['DIT CONSUMER SERVICE (CONS)','ENGINE TEAM GROUP'],
            ['DIT CONSUMER SERVICE (CONS)','DIVISI TV VIDEO'],
            ['DIT CONSUMER SERVICE (CONS)','SUBDIT PLANNING & RESOURCE MANAGEMENT'],
            ['DIT CONSUMER SERVICE (CONS)','SUBDIT MARKETING MANAGEMENT'],
            ['DIT CONSUMER SERVICE (CONS)','SUBDIT CONSUMER FULFILLMENT'],
            ['DIT CONSUMER SERVICE (CONS)','SUBDIT CONSUMER ASSURANCE'],
            ['DIT CONSUMER SERVICE (CONS)','SECRETARIATE DIT CONSUMER'],
            ['DIT ENTERPRISE & BUSINESS SERVICE (EBIS)','PROJECT BISNIS MILES'],
            ['DIT ENTERPRISE & BUSINESS SERVICE (EBIS)','PROBIS ICT OUTSOURCING SERVICE'],
            ['DIT ENTERPRISE & BUSINESS SERVICE (EBIS)','DIVISI GOVERNMENT SERVICE'],
            ['DIT ENTERPRISE & BUSINESS SERVICE (EBIS)','DIVISI BUSINESS SERVICE'],
            ['DIT ENTERPRISE & BUSINESS SERVICE (EBIS)','DIVISI ENTERPRISE SERVICE'],
            ['DIT ENTERPRISE & BUSINESS SERVICE (EBIS)','SEKRETARIAT DIREKTORAT EBIS'],
            ['DIT ENTERPRISE & BUSINESS SERVICE (EBIS)','ENTERPRISE PLANNING STRATEGY'],
            ['DIT ENTERPRISE & BUSINESS SERVICE (EBIS)','ENTERPRISE BUSINESS DEVELOPMENT'],
            ['DIT ENTERPRISE & BUSINESS SERVICE (EBIS)','ENTERPRISE PARENTING OPERATION'],
            ['DIT ENTERPRISE & BUSINESS SERVICE (EBIS)','ENTERPRISE PERFORMANCE INTEGRATION'],
            ['DIT ENTERPRISE & BUSINESS SERVICE (EBIS)','ENGINE TEAM GROUP'],
            ['DIT WHOLESALE & INTERNATIONAL SERV(WINS)','SEKRETARIAT DIREKTORAT WINS'],
            ['DIT WHOLESALE & INTERNATIONAL SERV(WINS)','SUB DIT WHOLESALE & INT\'L DEVELOPMENT'],
            ['DIT WHOLESALE & INTERNATIONAL SERV(WINS)','SUB DIT WHOLESALE & INT\'L VOICE SERVICE'],
            ['DIT WHOLESALE & INTERNATIONAL SERV(WINS)','SUB DIT WHOLESALE & NETWORK SERVICE'],
            ['DIT WHOLESALE & INTERNATIONAL SERV(WINS)','DIVISI WHOLESALE SERVICE'],
            ['DIT WHOLESALE & INTERNATIONAL SERV(WINS)','ENGINE TEAM GROUP'],
            ['DIT KEUANGAN (KEU)','PROYEK INTEGRATED SUPPLY CHAIN MGT'],
            ['DIT KEUANGAN (KEU)','ENGINE TEAM GROUP'],
            ['DIT KEUANGAN (KEU)','SEKRETARIAT DIT KEUANGAN'],
            ['DIT KEUANGAN (KEU)','DEPT FINANCIAL PLANNING & ANALISIS'],
            ['DIT KEUANGAN (KEU)','RISK & PROCESS MANAGEMENT'],
            ['DIT KEUANGAN (KEU)','INVESTOR RELATION'],
            ['DIT KEUANGAN (KEU)','SHARED SERVICE OPERATION FINANCE'],
            ['DIT KEUANGAN (KEU)','SSO PROCUREMENT & SOURCING'],
            ['DIT KEUANGAN (KEU)','CORPORATE FINANCE & FINANCIAL POLICY'],
            ['DIT KEUANGAN (KEU)','ASSET MANAGEMENT CENTER'],
            ['DIT KEUANGAN (KEU)','DEPT GROUP FIN PLANNING, ANALYSIS & CTRL'],
            ['DIT KEUANGAN (KEU)','CORPORATE FINANCE'],
            ['DIT KEUANGAN (KEU)','FINANCIAL POLICY & PROCESS MANAGEMENT'],
            ['DIT HUMAN CAPITAL MANAGEMENT (HCM)','COMMUNITY DEVELOPMENT CENTER'],
            ['DIT HUMAN CAPITAL MANAGEMENT (HCM)','ENGINE TEAM GROUP'],
            ['DIT HUMAN CAPITAL MANAGEMENT (HCM)','SEKRETARIAT DIREKTORAT HCM'],
            ['DIT HUMAN CAPITAL MANAGEMENT (HCM)','SUB DIT HC STRATEGIC MANAGEMENT'],
            ['DIT HUMAN CAPITAL MANAGEMENT (HCM)','SUB DIT HC DEVELOPMENT'],
            ['DIT HUMAN CAPITAL MANAGEMENT (HCM)','SUB DIT HC ORGANIZATIONAL EFFECTIVENESS'],
            ['DIT HUMAN CAPITAL MANAGEMENT (HCM)','SUB DIT TELKOM SMART OFFICE'],
            ['DIT HUMAN CAPITAL MANAGEMENT (HCM)','ASSESSMENT CENTER INDONESIA'],
            ['DIT HUMAN CAPITAL MANAGEMENT (HCM)','HUMAN CAPITAL BUSINESS PARTNER CENTER'],
            ['DIT HUMAN CAPITAL MANAGEMENT (HCM)','TELKOM CORPORATE UNIVERSITY CENTER'],
            ['DEPARTEMENT PROGRAM MANAGEMENT OFFICE','PMO PLANNING & DESIGN'],
            ['DEPARTEMENT PROGRAM MANAGEMENT OFFICE','MONITORING & REPORTING'],
            ['DEPARTEMENT PROGRAM MANAGEMENT OFFICE','COMMUNICATIONS & SUPPORTING'],
            ['DEPARTEMENT PROGRAM MANAGEMENT OFFICE','PMO CONTROLLER TEAM'],
            ['DEPARTEMENT CORPORATE SECRETARY','CORPORATE COMMUNICATION'],
            ['DEPARTEMENT CORPORATE SECRETARY','REGULATORY MANAGEMENT'],
            ['DEPARTEMENT CORPORATE SECRETARY','CORPORATE OFFICE SUPPORT'],
            ['DEPARTEMENT CORPORATE SECRETARY','LEGAL & COMPLIANCE'],
            ['DEPARTEMENT CORPORATE SECRETARY','ENGINE TEAM GROUP'],
            ['DEPARTEMENT INTERNAL AUDIT','INFRASTRUCTURE & OPERATION AUDIT'],
            ['DEPARTEMENT INTERNAL AUDIT','INTEGRATED & FINANCIAL AUDIT'],
            ['DEPARTEMENT INTERNAL AUDIT','PLANNING & DEVELOPMENT AUDIT'],
            ['DEPARTEMENT INTERNAL AUDIT','IT AUDIT'],
            ['DEPARTEMENT INTERNAL AUDIT','ENGINE TEAM GROUP'],
            ['DIT DIGITAL & STRATEGIC PORTFOLIO (DSP)','DIVISI DIGITAL SERVICE'],
            ['DIT DIGITAL & STRATEGIC PORTFOLIO (DSP)','SUBDIT CORPORATE STRATEGIC PLANNING'],
            ['DIT DIGITAL & STRATEGIC PORTFOLIO (DSP)','DEPT SYNERGY & PORTFOLIO'],
            ['DIT DIGITAL & STRATEGIC PORTFOLIO (DSP)','DEPT STRATEGIC INVESTMENT'],
            ['DIT DIGITAL & STRATEGIC PORTFOLIO (DSP)','DEPT MEDIA & DIGITAL BUSINESS'],
            ['DIT DIGITAL & STRATEGIC PORTFOLIO (DSP)','SEKRETARIAT DIREKTORAT DSP'],
            ['DIT DIGITAL & STRATEGIC PORTFOLIO (DSP)','CFU TRANSFORMATION'],
            ['DIT DIGITAL & STRATEGIC PORTFOLIO (DSP)','ENGINE TEAM GROUP'],
            ['DIT DIGITAL & STRATEGIC PORTFOLIO (DSP)','DEPT PORTFOLIO & SYNERGY'],
        ];

        foreach ($departments as $department) {
            $media_category = new UserDepartment;
            $media_category->parent = $department[0];
            $media_category->name = $department[1];
            $media_category->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::collection('user_departments')->raw(function($collection){
            $collection->drop();
        });
    }
}
