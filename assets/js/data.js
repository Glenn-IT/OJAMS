/* ==========================================================
   OJAMS – Static / Dummy Data
   All application data lives here. Replace with real API
   calls when a backend is connected.
========================================================== */

// ── Job Listings ─────────────────────────────────────────
const jobs = [
  {
    title: "Software Engineer",
    company: "TechCorp PH",
    desc: "Develop and maintain web applications.",
    qual: "BS Computer Science, 1 yr exp",
    date: "2026-03-01",
    status: "Open",
  },
  {
    title: "Data Analyst",
    company: "DataSync Inc.",
    desc: "Analyze and interpret complex data sets.",
    qual: "BS Statistics/IT, SQL skills",
    date: "2026-03-05",
    status: "Open",
  },
  {
    title: "Marketing Specialist",
    company: "BrandBoost Co.",
    desc: "Plan and execute marketing campaigns.",
    qual: "BS Marketing, social media exp",
    date: "2026-03-08",
    status: "Open",
  },
  {
    title: "Customer Support Rep",
    company: "Helpdesk PH",
    desc: "Handle customer inquiries and complaints.",
    qual: "Any 4-yr course, comm skills",
    date: "2026-03-10",
    status: "Open",
  },
  {
    title: "Graphic Designer",
    company: "PixelCraft Studio",
    desc: "Create visual concepts and designs.",
    qual: "BS Fine Arts / Multimedia",
    date: "2026-03-12",
    status: "Open",
  },
  {
    title: "HR Assistant",
    company: "PeopleFirst Corp.",
    desc: "Support HR operations and recruitment.",
    qual: "BS Psychology / HRDM",
    date: "2026-03-15",
    status: "Closed",
  },
];

// ── User's Own Applications ───────────────────────────────
const myApplications = [
  {
    title: "Software Engineer",
    company: "TechCorp PH",
    date: "2026-03-02",
    status: "Approved",
  },
  {
    title: "Data Analyst",
    company: "DataSync Inc.",
    date: "2026-03-06",
    status: "Pending",
  },
  {
    title: "Marketing Specialist",
    company: "BrandBoost Co.",
    date: "2026-03-09",
    status: "Rejected",
  },
];

// ── Admin – All Applications ──────────────────────────────
const adminApplications = [
  {
    name: "Juan Dela Cruz",
    title: "Software Engineer",
    company: "TechCorp PH",
    date: "2026-03-02",
    status: "Approved",
  },
  {
    name: "Maria Santos",
    title: "Data Analyst",
    company: "DataSync Inc.",
    date: "2026-03-06",
    status: "Pending",
  },
  {
    name: "Pedro Reyes",
    title: "Marketing Specialist",
    company: "BrandBoost Co.",
    date: "2026-03-09",
    status: "Rejected",
  },
  {
    name: "Ana Garcia",
    title: "Customer Support Rep",
    company: "Helpdesk PH",
    date: "2026-03-11",
    status: "Pending",
  },
  {
    name: "Luis Bautista",
    title: "Graphic Designer",
    company: "PixelCraft Studio",
    date: "2026-03-13",
    status: "Pending",
  },
];

// ── Admin – Recent Activity Log ───────────────────────────
const activityLog = [
  {
    date: "2026-03-22",
    time: "09:15 AM",
    activity: "Juan Dela Cruz applied for Software Engineer",
    status: "Approved",
  },
  {
    date: "2026-03-22",
    time: "10:02 AM",
    activity: "Maria Santos applied for Data Analyst",
    status: "Pending",
  },
  {
    date: "2026-03-21",
    time: "02:30 PM",
    activity: "Pedro Reyes applied for Marketing Specialist",
    status: "Rejected",
  },
  {
    date: "2026-03-21",
    time: "04:45 PM",
    activity: "Ana Garcia applied for Customer Support Rep",
    status: "Pending",
  },
  {
    date: "2026-03-20",
    time: "11:00 AM",
    activity: "New job posted: Graphic Designer",
    status: "—",
  },
];

// ── Admin – Monthly Report ────────────────────────────────
const monthlyReport = [
  { month: "January 2026", apps: 14, approved: 8, rejected: 3 },
  { month: "February 2026", apps: 19, approved: 11, rejected: 5 },
  { month: "March 2026", apps: 15, approved: 8, rejected: 4 },
];

// ── Sidebar Menu Definitions ──────────────────────────────
const userMenu = [
  { icon: "bi-search", label: "Browse Jobs", section: "sec-browse" },
  {
    icon: "bi-file-earmark-text",
    label: "My Applications",
    section: "sec-myapps",
  },
  {
    icon: "bi-person-circle",
    label: "Profile Settings",
    section: "sec-profile",
  },
  { icon: "bi-box-arrow-left", label: "Logout", section: "logout" },
];

const adminMenu = [
  { icon: "bi-speedometer2", label: "Dashboard", section: "sec-dashboard" },
  { icon: "bi-briefcase", label: "Manage Jobs", section: "sec-manage-jobs" },
  {
    icon: "bi-folder2-open",
    label: "Applications",
    section: "sec-applications",
  },
  { icon: "bi-bar-chart-line", label: "Reports", section: "sec-reports" },
  { icon: "bi-box-arrow-left", label: "Logout", section: "logout" },
];
